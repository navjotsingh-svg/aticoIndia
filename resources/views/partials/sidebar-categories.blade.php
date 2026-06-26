<h3 class="sidebar-title sidebar-title--categories">Categories</h3>
<div class="sidebar-category-accordion" id="sidebarCategoryAccordion">
    @forelse($sidebarCategories as $category)
        <div class="sidebar-category-card">
            <div class="sidebar-category-header">
                <button
                    type="button"
                    class="sidebar-category-toggle{{ $loop->first ? ' is-open' : '' }}"
                    data-target="sidebar-cat-{{ $category->slug }}"
                    aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                >
                    {{ $category->name }}
                </button>
            </div>
            <div
                id="sidebar-cat-{{ $category->slug }}"
                class="sidebar-category-panel{{ $loop->first ? ' is-open' : '' }}"
            >
                @foreach($category->sub_cats as $subCat)
                    <p class="sidebar-category-link">
                        <a href="{{ route('category.show', $subCat->slug) }}">
                            {{ $subCat->short_name ?: $subCat->name }}
                        </a>
                    </p>
                @endforeach
            </div>
        </div>
    @empty
        @foreach($menuCategories as $category)
            <div class="sidebar-category-card">
                <div class="sidebar-category-header">
                    <button
                        type="button"
                        class="sidebar-category-toggle{{ $loop->first ? ' is-open' : '' }}"
                        data-target="sidebar-cat-{{ $category->slug }}"
                        aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                    >
                        {{ $category->short_name ?: $category->name }}
                    </button>
                </div>
                <div
                    id="sidebar-cat-{{ $category->slug }}"
                    class="sidebar-category-panel{{ $loop->first ? ' is-open' : '' }}"
                >
                    @foreach($category->children ?? [] as $subCat)
                        <p class="sidebar-category-link">
                            <a href="{{ route('category.show', $subCat->slug) }}">
                                {{ $subCat->short_name ?: $subCat->name }}
                            </a>
                        </p>
                    @endforeach
                </div>
            </div>
        @endforeach
    @endforelse
</div>

@once
    @push('scripts')
    <script>
        (() => {
            const accordion = document.getElementById('sidebarCategoryAccordion');
            if (!accordion) return;

            accordion.querySelectorAll('.sidebar-category-toggle').forEach((toggle) => {
                toggle.addEventListener('click', () => {
                    const panelId = toggle.getAttribute('data-target');
                    const panel = panelId ? document.getElementById(panelId) : null;
                    if (!panel) return;

                    const isOpen = toggle.classList.contains('is-open');

                    accordion.querySelectorAll('.sidebar-category-toggle').forEach((btn) => {
                        btn.classList.remove('is-open');
                        btn.setAttribute('aria-expanded', 'false');
                    });
                    accordion.querySelectorAll('.sidebar-category-panel').forEach((el) => {
                        el.classList.remove('is-open');
                    });

                    if (!isOpen) {
                        toggle.classList.add('is-open');
                        toggle.setAttribute('aria-expanded', 'true');
                        panel.classList.add('is-open');
                    }
                });
            });
        })();
    </script>
    @endpush
@endonce
