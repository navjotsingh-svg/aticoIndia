<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('faqs')) {
            Schema::create('faqs', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->text('description')->nullable();
                $table->unsignedTinyInteger('status')->default(1);
                $table->string('section_heading')->nullable();
                $table->text('section_description')->nullable();
                $table->unsignedBigInteger('created_by')->nullable();
                $table->unsignedBigInteger('updated_by')->nullable();
                $table->unsignedBigInteger('deleted_by')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (DB::table('faqs')->count() > 0) {
            return;
        }

        $quoteUrl = url('/#quote');

        DB::table('faqs')->insert([
            [
                'name' => 'What is the minimum order that we can place?',
                'description' => 'We expect your minimum orders to be of at least US $500. However, we understand that customers need to place smaller Sample orders in the beginning in order to test market our products. Samples against cost are available on request.',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'What are your payment terms?',
                'description' => '<p>All payment should be made in US dollars unless otherwise specified in the quotation sent to you. We give the following options for payment:</p>
<ol>
<li><strong>Full Advance Payment:</strong> This method is most convenient for small orders as it minimizes the bank charges involved in other methods of payment. You may send payment by Check or Bank Draft favoring Advanced Technocracy Inc. to our postal address, or, you may send Telegraphic Transfer (TT) or Wire Transfer to our Bankers under intimation to us.</li>
<li><strong>Part Payment in Advance:</strong> For larger orders, we expect that you send 75% value in advance. Balance payment is payable against delivery of documents through your bank. This method involves Bank Charges which are payable by the customer.</li>
<li><strong>Credit Cards:</strong> We accept small payment only by Credit Cards.</li>
</ol>',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'What are your Bank Particulars?',
                'description' => '<p><strong>Bank Name:</strong> ICICI Bank Ltd.</p>
<p><strong>Bank Swift Code:</strong> ICICINBBCTS<br>
<strong>Beneficiary Account No:</strong> 049805500100<br>
<strong>Beneficiary Name:</strong> ADVANCED TECHNOCRACY INC.<br>
FOR THE CREDIT OF ICICI BANK LTD INDIA ACCOUNT NO 001-1-427374<br>
<strong>Bank Swift Code:</strong> ICICINBBCTS<br>
<strong>Branch Name:</strong> ICICI Bank Ambala Cantt</p>
<p><strong>Note:</strong> Please inform us before and after sending any payment to our Bank Account.</p>',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Please give some information on Shipping mode and charges?',
                'description' => '<p>The normal mode of shipment is – “Sea Freight” and “Air Freight”. However, we also use Air Post Parcel, Sea Post Parcel, Courier, etc. upon special requests from customers.</p>
<p>It is your option to ask for prices inclusive of shipping costs or we can send the goods on “Freight To Pay basis”.</p>
<p>The shipping charges vary according to the size of shipment, destination, and Mode of dispatch. C.I.F. rates are quoted if you inform us the exact quantity, destination, and mode of dispatch preferred by you.</p>',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'How can I get a Quote?',
                'description' => '<p>Please <a href="' . $quoteUrl . '">click here</a> to fill the Request of Quotation Form.</p>',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'How can I get your Price List / Catalogue?',
                'description' => '<p>Please <a href="' . $quoteUrl . '">click here</a> to fill the Request for Price List Form.</p>',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Do you have ISO 9000, CE approvals?',
                'description' => '<p>Yes, we are An ISO 9001:2000 and CE Certified Company. Please inform us about the product and your requirement and we shall inform you if they are certified.</p>',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'How can I contact Atico Export?',
                'description' => '<p>You can Contact Advanced Technocracy Inc. by E-mail, Fax, Phone or Post.<br>
For any reasons, use any of the following methods:</p>
<p><strong>E-Mail:</strong> <a href="mailto:sales@aticoindia.com">sales@aticoindia.com</a><br>
<strong>Phone:</strong> <a href="tel:+919896793832">+91 98967 93832</a>, <a href="tel:+919996186555">+91 99961 86555</a></p>',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
