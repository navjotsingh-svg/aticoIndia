<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\Product;
use App\Models\ProductQuery;
use App\Models\QuoteEnquire;
use App\Models\RequestQuote;
use App\Rules\RecaptchaRule;
use App\Services\InquirySubmissionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function __construct(
        private readonly InquirySubmissionService $inquiryMail,
    ) {}

    public function contact(Request $request): RedirectResponse
    {
        $data = $request->validate(array_merge($this->sharedInquiryRules(), [
            'name' => 'required|string|max:1000',
            'email' => 'nullable|email|max:1000',
            'mobile_no' => 'nullable|string|max:1000',
            'message' => 'nullable|string',
            'page_url' => 'nullable|string|max:2000',
            'ip_address' => 'nullable|string|max:100',
        ], $this->inquiryMail->attachmentRules()));

        $filePath = $this->inquiryMail->storeAttachment($request);
        $data['file_name'] = $filePath;

        Enquiry::create($data);

        $this->inquiryMail->sendContactEnquiry($data, $filePath, $this->inquiryMail->pageMeta($request));

        return back()->with('success', 'Thank you. Your enquiry was submitted.');
    }

    public function product(Request $request): RedirectResponse
    {
        $data = $request->validate(array_merge($this->sharedInquiryRules(), [
            'product_id' => 'nullable|integer',
            'name' => 'required|string|max:1000',
            'email' => 'nullable|email|max:1000',
            'phone_number' => 'nullable|string|max:1000',
            'quantity' => 'nullable|string|max:100',
            'message' => 'nullable|string|max:1000',
            'page_url' => 'nullable|string|max:2000',
            'ip_address' => 'nullable|string|max:100',
        ], $this->inquiryMail->attachmentRules()));

        $filePath = $this->inquiryMail->storeAttachment($request);
        $data['file_name'] = $filePath;

        ProductQuery::create($data);

        $productName = '';
        if (! empty($data['product_id'])) {
            $productName = (string) Product::query()->where('id', $data['product_id'])->value('name');
        }

        $this->inquiryMail->sendProductQuery($data, $productName, $this->inquiryMail->pageMeta($request));

        return back()->with('success', 'Product query submitted successfully.');
    }

    public function requestQuote(Request $request): RedirectResponse
    {
        $data = $request->validate(array_merge($this->sharedInquiryRules(), [
            'name' => 'required|string|max:1000',
            'email' => 'nullable|email|max:1000',
            'mobile_no' => 'nullable|string|max:1000',
            'product' => 'nullable|string|max:1000',
            'query' => 'nullable|string',
            'page_url' => 'nullable|string|max:2000',
            'ip_address' => 'nullable|string|max:100',
        ], $this->inquiryMail->attachmentRules()));

        $filePath = $this->inquiryMail->storeAttachment($request);
        $data['file_name'] = $filePath;

        RequestQuote::create($data);

        $this->inquiryMail->sendQuoteRequest(
            array_merge($data, ['message' => $data['query'] ?? '']),
            $filePath,
            $this->inquiryMail->pageMeta($request),
            'Quote Request Received',
        );

        return back()->with('success', 'Quote request submitted successfully.');
    }

    public function quoteEnquiry(Request $request): RedirectResponse
    {
        $data = $request->validate(array_merge($this->sharedInquiryRules(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone_number' => 'nullable|string|max:30',
            'massage' => 'nullable|string',
            'page_url' => 'nullable|string|max:2000',
            'ip_address' => 'nullable|string|max:100',
        ], $this->inquiryMail->attachmentRules()));

        $filePath = $this->inquiryMail->storeAttachment($request);

        QuoteEnquire::create($data);

        $this->inquiryMail->sendQuoteRequest(
            [
                'name' => $data['name'],
                'email' => $data['email'] ?? '',
                'country' => $data['country'] ?? '',
                'mobile_no' => $data['phone_number'] ?? '',
                'massage' => $data['massage'] ?? '',
            ],
            $filePath,
            $this->inquiryMail->pageMeta($request),
            'Quote Enquiry Received',
        );

        return back()->with('success', 'Quote enquiry submitted successfully.');
    }

    /**
     * @return array<string, mixed>
     */
    private function sharedInquiryRules(): array
    {
        $rules = [
            'country' => 'required|string|max:1000',
        ];

        if (config('inquiry.recaptcha_secret_key')) {
            $rules['g-recaptcha-response'] = ['required', new RecaptchaRule()];
        }

        return $rules;
    }
}
