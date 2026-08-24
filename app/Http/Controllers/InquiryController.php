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
        $data = $request->validate(
            array_merge($this->sharedInquiryRules(), $this->contactIdentityRules(), [
                'name' => 'required|string|max:1000',
                'message' => 'nullable|string',
                'page_url' => 'nullable|string|max:2000',
                'ip_address' => 'nullable|string|max:100',
            ], $this->inquiryMail->attachmentRules()),
            $this->inquiryMessages(),
        );

        $filePath = $this->inquiryMail->storeAttachment($request);
        $data['file_name'] = $filePath;

        Enquiry::create($data);

        $this->inquiryMail->sendContactEnquiry($data, $filePath, $this->inquiryMail->pageMeta($request));

        return back()->with($this->enquirySuccessResponse(
            'Thank you. Your enquiry was submitted successfully. Our team will contact you shortly.'
        ));
    }

    public function product(Request $request): RedirectResponse
    {
        $data = $request->validate(
            array_merge($this->sharedInquiryRules(), $this->productIdentityRules(), [
                'product_id' => 'nullable|integer',
                'name' => 'required|string|max:1000',
                'quantity' => 'nullable|string|max:100',
                'message' => 'nullable|string|max:1000',
                'page_url' => 'nullable|string|max:2000',
                'ip_address' => 'nullable|string|max:100',
            ], $this->inquiryMail->attachmentRules()),
            $this->inquiryMessages(),
        );

        $filePath = $this->inquiryMail->storeAttachment($request);
        $data['file_name'] = $filePath;

        ProductQuery::create($data);

        $productName = '';
        if (! empty($data['product_id'])) {
            $productName = (string) Product::query()->where('id', $data['product_id'])->value('name');
        }

        $this->inquiryMail->sendProductQuery($data, $productName, $this->inquiryMail->pageMeta($request));

        return back()->with(array_merge(
            $this->enquirySuccessResponse('Product query submitted successfully. Our team will contact you shortly.'),
            [
                'product_query_success' => true,
                'product_query_id' => $data['product_id'] ?? null,
            ]
        ));
    }

    public function requestQuote(Request $request): RedirectResponse
    {
        $data = $request->validate(
            array_merge($this->sharedInquiryRules(), $this->contactIdentityRules(), [
                'name' => 'required|string|max:1000',
                'product' => 'nullable|string|max:1000',
                'query' => 'nullable|string',
                'page_url' => 'nullable|string|max:2000',
                'ip_address' => 'nullable|string|max:100',
            ], $this->inquiryMail->attachmentRules()),
            $this->inquiryMessages(),
        );

        $filePath = $this->inquiryMail->storeAttachment($request);
        $data['file_name'] = $filePath;

        RequestQuote::create($data);

        $this->inquiryMail->sendQuoteRequest(
            array_merge($data, ['message' => $data['query'] ?? '']),
            $filePath,
            $this->inquiryMail->pageMeta($request),
            'Quote Request Received',
        );

        return back()->with($this->enquirySuccessResponse(
            'Quote request submitted successfully. Our team will contact you shortly.'
        ));
    }

    public function quoteEnquiry(Request $request): RedirectResponse
    {
        $data = $request->validate(
            array_merge($this->sharedInquiryRules(), $this->productIdentityRules(), [
                'name' => 'required|string|max:255',
                'massage' => 'nullable|string',
                'page_url' => 'nullable|string|max:2000',
                'ip_address' => 'nullable|string|max:100',
            ], $this->inquiryMail->attachmentRules()),
            $this->inquiryMessages(),
        );

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

        return back()->with($this->enquirySuccessResponse(
            'Quote enquiry submitted successfully. Our team will contact you shortly.'
        ));
    }

    /**
     * @return array<string, string>
     */
    private function contactIdentityRules(): array
    {
        return [
            'email' => 'nullable|email|max:1000|required_without:mobile_no',
            'mobile_no' => 'nullable|string|max:1000|required_without:email',
        ];
    }

    /**
     * @return array<string, string>
     */
    private function productIdentityRules(): array
    {
        return [
            'email' => 'nullable|email|max:1000|required_without:phone_number',
            'phone_number' => 'nullable|string|max:1000|required_without:email',
        ];
    }

    /**
     * @return array<string, string>
     */
    private function inquiryMessages(): array
    {
        return [
            'email.required_without' => 'Please provide an email address or phone number so we can contact you.',
            'mobile_no.required_without' => 'Please provide an email address or phone number so we can contact you.',
            'phone_number.required_without' => 'Please provide an email address or phone number so we can contact you.',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    private function enquirySuccessResponse(string $message): array
    {
        return [
            'success' => $message,
            'enquiry_success' => true,
        ];
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
