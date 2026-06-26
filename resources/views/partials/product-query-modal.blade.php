<div class="product-query-modal" id="productQueryModal" aria-hidden="true">
    <div class="product-query-modal-backdrop" data-close-product-query></div>
    <div class="product-query-modal-card" role="dialog" aria-labelledby="productQueryModalTitle">
        <button type="button" class="product-query-modal-close" data-close-product-query aria-label="Close">&times;</button>
        <h3 id="productQueryModalTitle">{{ $product->name }} — Query</h3>
        <form method="post" action="{{ route('product-query.store') }}" enctype="multipart/form-data">
            @csrf
            @include('partials.inquiry-meta')
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input class="input" name="name" placeholder="Name" required value="{{ old('name') }}">
            <input class="input" type="email" name="email" placeholder="Email" value="{{ old('email') }}">
            @include('partials.inquiry-country')
            <input class="input" name="phone_number" placeholder="Phone Number" value="{{ old('phone_number') }}">
            <input class="input" name="quantity" placeholder="Quantity" value="{{ old('quantity') }}">
            <textarea name="message" rows="4" placeholder="Message">{{ old('message') }}</textarea>
            @include('partials.inquiry-attachment')
            @include('partials.inquiry-recaptcha')
            <button class="btn btn-block" type="submit">Submit</button>
        </form>
    </div>
</div>

@push('scripts')
<script>
    (() => {
        const modal = document.getElementById('productQueryModal');
        if (!modal) return;

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

        @if($errors->any() && old('product_id') == $product->id)
            open();
        @endif
    })();
</script>
@endpush
