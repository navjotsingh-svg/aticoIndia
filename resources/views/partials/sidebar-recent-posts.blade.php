<h3 class="sidebar-title sidebar-title--recent">Recent Posts</h3>
<ul class="sidebar-recent-posts">
    @forelse($recentPosts as $post)
        @php
            $image = (string) ($post->image ?? '');
            $imagePath = $image !== ''
                ? (str_starts_with($image, 'http')
                    ? $image
                    : asset(ltrim(str_contains($image, '/') ? $image : 'uploads/blog_images/' . $image, '/')))
                : asset('assets/frontend/images/no_product.png');
        @endphp
        <li class="sidebar-recent-post">
            <a href="{{ route('blog.show', $post->slug) }}" class="sidebar-recent-post-thumb">
                <img
                    src="{{ $imagePath }}"
                    alt="{{ $post->img_alt ?? $post->name }}"
                    loading="lazy"
                    onerror="this.onerror=null;this.src='{{ asset('assets/frontend/images/no_product.png') }}';"
                >
            </a>
            <div class="sidebar-recent-post-body">
                <a href="{{ route('blog.show', $post->slug) }}" class="sidebar-recent-post-title">
                    {{ $post->name }}
                </a>
                <span class="sidebar-recent-post-date">{{ optional($post->created_at)->format('M d, Y') }}</span>
            </div>
        </li>
    @empty
        <li class="sidebar-recent-post-empty muted">No other posts yet.</li>
    @endforelse
</ul>
