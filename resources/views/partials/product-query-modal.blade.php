<div class="product-query-modal" id="productQueryModal" aria-hidden="true">
    <div class="product-query-modal-backdrop" data-close-product-query></div>
    <div class="product-query-modal-card" role="dialog" aria-labelledby="productQueryModalTitle">
        <button type="button" class="product-query-modal-close" data-close-product-query aria-label="Close">&times;</button>
        <h3 id="productQueryModalTitle">{{ $product->name }} — Query</h3>

        <div class="product-query-success" id="productQuerySuccess" @if(!session('product_query_success') || (int) session('product_query_id') !== (int) $product->id) hidden @endif>
            <div class="form-success-icon" aria-hidden="true"><i class="fa fa-check-circle"></i></div>
            <p>{{ session('success', 'Product query submitted successfully. Our team will contact you shortly.') }}</p>
            <button type="button" class="btn btn-block" data-close-product-query>Close</button>
        </div>

        <form method="post" action="{{ route('product-query.store') }}" enctype="multipart/form-data" data-inquiry-form @if(session('product_query_success') && (int) session('product_query_id') === (int) $product->id) hidden @endif>
            @csrf
            @include('partials.inquiry-meta')
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input class="input @error('name') is-invalid @enderror" name="name" placeholder="Name *" required value="{{ old('name') }}">
            @error('name')
                <span class="field-error">{{ $message }}</span>
            @enderror
            @include('partials.inquiry-contact-fields', ['phoneField' => 'phone_number'])
            @include('partials.inquiry-country')
            @error('country')
                <span class="field-error">{{ $message }}</span>
            @enderror
            <input class="input" name="quantity" placeholder="Quantity" value="{{ old('quantity') }}">
            <textarea name="message" rows="4" placeholder="Message">{{ old('message') }}</textarea>
            @include('partials.inquiry-attachment')
            @include('partials.inquiry-recaptcha')
            @error('g-recaptcha-response')
                <span class="field-error">{{ $message }}</span>
            @enderror
            <button class="btn btn-block" type="submit">Submit</button>
        </form>
    </div>
</div>

@push('scripts')
<script>
    (() => {
        const modal = document.getElementById('productQueryModal');
        if (!modal) return;

        const form = modal.querySelector('form[data-inquiry-form]');
        const success = document.getElementById('productQuerySuccess');

        const open = () => {
            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');
            document.body.classList.add('modal-open');
        };

        const close = () => {
            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('modal-open');
        };

        document.querySelectorAll('[data-open-product-query]').forEach((btn) => {
            btn.addEventListener('click', open);
        });

        modal.querySelectorAll('[data-close-product-query]').forEach((el) => {
            el.addEventListener('click', close);
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && modal.classList.contains('is-open')) {
                close();
            }
        });

        @if($errors->any() && (int) old('product_id') === (int) $product->id)
            open();
        @endif

        @if(session('product_query_success') && (int) session('product_query_id') === (int) $product->id)
            open();
        @endif
    })();
</script>
@endpush
