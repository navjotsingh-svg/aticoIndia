<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InquirySubmissionService
{
    public function attachmentRules(): array
    {
        $mimes = implode(',', config('inquiry.allowed_mimes', ['pdf', 'doc', 'docx', 'xls', 'xlsx']));
        $max = (int) config('inquiry.max_file_kb', 10240);

        return [
            'file_name' => ['nullable', 'file', "mimes:{$mimes}", "max:{$max}"],
        ];
    }

    public function storeAttachment(Request $request): ?string
    {
        if (! $request->hasFile('file_name')) {
            return null;
        }

        $file = $request->file('file_name');

        if (! $file instanceof UploadedFile || ! $file->isValid()) {
            return null;
        }

        $directory = public_path('files');

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $filename = time().'_'.$file->getClientOriginalName();
        $file->move($directory, $filename);

        return '/files/'.$filename;
    }

    public function pageMeta(Request $request): array
    {
        return [
            'page_url' => $request->input('page_url', $request->fullUrl()),
            'ip_address' => $request->input('ip_address', $request->ip() ?? ''),
        ];
    }

    /**
     * General enquiry — same flow as old EnquiryController::store().
     */
    public function sendContactEnquiry(array $enquiry, ?string $filePath, array $meta): void
    {
        $customerEmail = trim((string) ($enquiry['email'] ?? ''));

        $data = [
            'name' => $enquiry['name'] ?? '',
            'email' => $customerEmail,
            'country' => $enquiry['country'] ?? '',
            'mobile_no' => $enquiry['mobile_no'] ?? '',
            'massage' => $enquiry['message'] ?? '',
            'file_name' => $filePath ?? '',
            'page_url' => $meta['page_url'] ?? '',
            'ip_address' => $meta['ip_address'] ?? '',
        ];

        $notifyTo = config('inquiry.notify_email');
        $fromAddress = config('inquiry.mail_from');
        $fromName = $enquiry['name'] ?? config('inquiry.mail_from_name');

        $this->mailSend('emails.contact_us', $data, function ($message) use ($fromAddress, $fromName, $notifyTo) {
            $message->from($fromAddress, $fromName);
            $message->to($notifyTo);
            $message->subject('Enquiry Received');
        });

        if ($customerEmail !== '') {
            $this->mailSend('emails.contact_us', $data, function ($message) use ($fromAddress, $customerEmail) {
                $message->from($fromAddress);
                $message->to($customerEmail);
                $message->subject('Enquiry Received');
            });
        }
    }

    /**
     * Product query — same flow as old ProductQueryController::store().
     */
    public function sendProductQuery(array $query, ?string $productName, array $meta): void
    {
        $customerEmail = trim((string) ($query['email'] ?? ''));

        $data = [
            'product' => $productName ?? '',
            'name' => $query['name'] ?? '',
            'email' => $customerEmail,
            'country' => $query['country'] ?? '',
            'phone_number' => $query['phone_number'] ?? '',
            'quantity' => $query['quantity'] ?? '',
            'massage' => $query['message'] ?? '',
            'page_url' => $meta['page_url'] ?? '',
            'ip_address' => $meta['ip_address'] ?? '',
        ];

        $notifyTo = config('inquiry.notify_email');
        $fromAddress = config('inquiry.mail_from');

        $this->mailSend('emails.product_query', $data, function ($message) use ($fromAddress, $query, $notifyTo) {
            $message->from($fromAddress, $query['name'] ?? '');
            $message->to($notifyTo);
            $message->subject('Product Query Received');
        });
    }

    /**
     * Quote / contact forms using the contact_us template.
     */
    public function sendQuoteRequest(array $fields, ?string $filePath, array $meta, string $subject = 'Quote Request Received'): void
    {
        $customerEmail = trim((string) ($fields['email'] ?? ''));

        $data = [
            'name' => $fields['name'] ?? '',
            'email' => $customerEmail,
            'country' => $fields['country'] ?? '',
            'mobile_no' => $fields['mobile_no'] ?? $fields['phone_number'] ?? '',
            'massage' => $fields['message'] ?? $fields['query'] ?? $fields['massage'] ?? '',
            'file_name' => $filePath ?? '',
            'page_url' => $meta['page_url'] ?? '',
            'ip_address' => $meta['ip_address'] ?? '',
        ];

        $notifyTo = config('inquiry.notify_email');
        $fromAddress = config('inquiry.mail_from');
        $fromName = $fields['name'] ?? config('inquiry.mail_from_name');

        $this->mailSend('emails.contact_us', $data, function ($message) use ($fromAddress, $fromName, $notifyTo, $subject) {
            $message->from($fromAddress, $fromName);
            $message->to($notifyTo);
            $message->subject($subject);
        });

        if ($customerEmail !== '') {
            $this->mailSend('emails.contact_us', $data, function ($message) use ($fromAddress, $customerEmail, $subject) {
                $message->from($fromAddress);
                $message->to($customerEmail);
                $message->subject($subject);
            });
        }
    }

    private function mailSend(string $view, array $data, callable $callback): void
    {
        try {
            Mail::send($view, $data, $callback);
        } catch (\Throwable $e) {
            Log::error('Mail send failed: '.$e->getMessage(), ['view' => $view]);
        }
    }
}
