<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (! DB::getSchemaBuilder()->hasTable('faqs')) {
            return;
        }

        $contactUrl = url('/contact-us');
        $enquiryUrl = url('/#quote');

        $faqs = [
            [
                'name' => 'What is the minimum order that we can place?',
                'description' => 'We expect minimum orders of at least US $500. We understand that customers may need smaller sample orders initially to evaluate our products. Sample orders are available on request at cost.',
            ],
            [
                'name' => 'What are your payment terms?',
                'description' => '<p>All payments should be made in US dollars unless otherwise specified in the quotation sent to you. We offer the following payment options:</p>
<ol>
<li><strong>Full Advance Payment:</strong> This method is most convenient for smaller orders as it minimizes bank charges. You may send payment by cheque or bank draft favoring <strong>Atico India</strong> to our postal address, or remit funds by Telegraphic Transfer (TT) or Wire Transfer to our bank account under intimation to us.</li>
<li><strong>Part Payment in Advance:</strong> For larger orders, we typically require 75% payment in advance. The balance is payable against delivery of documents through your bank. Bank charges involved in this method are payable by the customer.</li>
<li><strong>Credit Cards:</strong> We accept credit card payments for smaller orders only.</li>
</ol>',
            ],
            [
                'name' => 'What are your Bank Particulars?',
                'description' => '<p><strong>Bank Name:</strong> ICICI Bank Ltd.</p>
<p><strong>Bank Swift Code:</strong> ICICINBBCTS<br>
<strong>Beneficiary Account No:</strong> 049805500100<br>
<strong>Beneficiary Name:</strong> ATICO INDIA<br>
<strong>Branch Name:</strong> ICICI Bank, Ambala Cantt, Haryana, India</p>
<p><strong>Note:</strong> Please inform us before and after sending any payment to our bank account.</p>',
            ],
            [
                'name' => 'Please give some information on Shipping mode and charges?',
                'description' => '<p>The normal modes of shipment are sea freight and air freight. We can also arrange air post parcel, sea post parcel, or courier dispatch upon special request.</p>
<p>You may request prices inclusive of shipping costs, or we can ship goods on a freight-to-pay basis.</p>
<p>Shipping charges depend on shipment size, destination, and mode of dispatch. C.I.F. rates can be quoted once you share the exact quantity, destination, and preferred dispatch method.</p>',
            ],
            [
                'name' => 'How can I get a Quote?',
                'description' => '<p>Please <a href="' . $enquiryUrl . '">request a quote</a> using the enquiry form on our website, or <a href="' . $contactUrl . '">contact us</a> with your product list and requirements. Our team will respond with pricing and availability.</p>',
            ],
            [
                'name' => 'How can I get your Price List / Catalogue?',
                'description' => '<p>Please <a href="' . $enquiryUrl . '">send an enquiry</a> or <a href="' . $contactUrl . '">contact us</a> with the categories or products you are interested in. We will share the relevant catalogue details and pricing based on your requirements.</p>',
            ],
            [
                'name' => 'Do you have ISO 9000, CE approvals?',
                'description' => '<p>Yes, Atico India is an ISO 9001 and CE certified manufacturer. Please share your product requirements and we will confirm applicable certifications for the items you need.</p>',
            ],
            [
                'name' => 'How can I contact Atico India?',
                'description' => '<p>You can reach Atico India by email, phone, fax, or post:</p>
<p><strong>Address:</strong> 5309, Grain Market, Near B.D. Sen. Sec. School, Ambala Cantt-133001, Haryana, India<br>
<strong>Email:</strong> <a href="mailto:sales@aticoindia.com">sales@aticoindia.com</a><br>
<strong>Phone:</strong> <a href="tel:+919896793832">+91-9896793832</a>, <a href="tel:+919996186555">+91-9996186555</a><br>
<strong>Fax:</strong> +91-0171-4004736<br>
<strong>Website:</strong> <a href="https://www.aticoindia.com" target="_blank" rel="noreferrer">www.aticoindia.com</a></p>
<p>You can also use our <a href="' . $contactUrl . '">Contact Us</a> page or the enquiry form on this website.</p>',
            ],
        ];

        foreach ($faqs as $faq) {
            DB::table('faqs')
                ->where('name', $faq['name'])
                ->update([
                    'description' => $faq['description'],
                    'updated_at' => now(),
                ]);
        }

        DB::table('faqs')
            ->where('name', 'How can I contact Atico Export?')
            ->update([
                'name' => 'How can I contact Atico India?',
                'description' => $faqs[7]['description'],
                'updated_at' => now(),
            ]);

        foreach ($faqs as $faq) {
            if (DB::table('faqs')->where('name', $faq['name'])->exists()) {
                continue;
            }

            DB::table('faqs')->insert([
                'name' => $faq['name'],
                'description' => $faq['description'],
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $contactFaqIds = DB::table('faqs')
            ->where('name', 'How can I contact Atico India?')
            ->orderBy('id')
            ->pluck('id');

        if ($contactFaqIds->count() > 1) {
            DB::table('faqs')
                ->whereIn('id', $contactFaqIds->slice(1)->values()->all())
                ->delete();
        }

        DB::table('faqs')
            ->where(function ($query): void {
                $query->where('description', 'like', '%Advanced Technocracy%')
                    ->orWhere('description', 'like', '%aticoexport%')
                    ->orWhere('description', 'like', '%Atico Export%');
            })
            ->update([
                'description' => DB::raw("REPLACE(REPLACE(REPLACE(description, 'Advanced Technocracy Inc.', 'Atico India'), 'ADVANCED TECHNOCRACY INC.', 'ATICO INDIA'), 'Atico Export', 'Atico India')"),
                'updated_at' => now(),
            ]);
    }

    public function down(): void
    {
        // FAQ content rollback is not restored to legacy branding.
    }
};
