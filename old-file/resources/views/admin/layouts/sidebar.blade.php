<nav class="main-menu">
    <ul>
        <li>
            <a href="{!! route('dashboard') !!}">
                <i class="fa fa-home nav_icon"></i>
                <span class="nav-text">
                    Dashboard
                </span>
            </a>
        </li>
        <li class="has-subnav">
            <a href="javascript:;">
                <i class="fa fa-list-alt" aria-hidden="true"></i>
                <span class="nav-text">
                    Category
                </span>
                <i class="icon-angle-right"></i><i class="icon-angle-down"></i>
            </a>
            <ul>
                <li>
                    <a class="subnav-text" href="{!! route('category.create') !!}">
                        Add Category
                    </a>
                </li>
                <li>
                    <a class="subnav-text" href="{!! route('category.index') !!}">
                        Category List
                    </a>
                </li>

                <li>
                    <a class="subnav-text" href="{!! route('sub_category.create') !!}">
                        Add Sub Category
                    </a>
                </li>
                <li>
                    <a class="subnav-text" href="{!! route('sub_category.index') !!}">
                        Sub Category List
                    </a>
                </li>

                <li>
                    <a class="subnav-text" href="{!! route('sub_sub_category.create') !!}">
                        Add Sub-Sub Category
                    </a>
                </li>
                <li>
                    <a class="subnav-text" href="{!! route('sub_sub_category.index') !!}">
                        Sub-Sub Category List
                    </a>
                </li>

                <li>
                    <a class="subnav-text" href="{!! route('get_unallocated_cats') !!}">
                        Un-Allocated Categories
                    </a>
                </li>

                <!-- <li>
                    <a class="subnav-text" href="{!! route('cat_no_product') !!}">
                        Category No Product
                    </a>
                </li>

                <li>
                    <a class="subnav-text" href="{!! route('sub_cat_no_product') !!}">
                        Sub Category No Product
                    </a>
                </li>

                <li>
                    <a class="subnav-text" href="{!! route('sub_sub_cat_no_product') !!}">
                        Sub Sub Category No Product
                    </a>
                </li>

                <li>
                    <a class="subnav-text" href="{!! route('cat_change_status') !!}">
                        Category Change Status
                    </a>
                </li>

                <li>
                    <a class="subnav-text" href="{!! route('sub_cat_change_status') !!}">
                        Sub Category Change Status
                    </a>
                </li>
                <li>
                    <a class="subnav-text" href="{!! route('sub_sub_cat_change_status') !!}">
                        Sub Sub Category Change Status
                    </a>
                </li>
                <li>
                    <a class="subnav-text" href="{!! route('category_product') !!}">
                        Category Product
                    </a>
                </li>

                <li>
                    <a class="subnav-text" href="{!! route('sub_category_product') !!}">
                        Sub Category Product
                    </a>
                </li>

                <li>
                    <a class="subnav-text" href="{!! route('replace_cat_name') !!}">
                        Replace Category Name
                    </a>
                </li>

                <li>
                    <a class="subnav-text" href="{!! route('duplicate_slug') !!}">
                        Duplicate Slug
                    </a>
                </li> -->

                <!-- <li>
                    <a class="subnav-text" href="{!! route('category_import') !!}">
                        Import Category
                    </a>
                </li> -->
            </ul>
        </li>
        <li class="has-subnav">
            <a href="javascript:;">
                <i class="fa fa-list-alt" aria-hidden="true"></i>
                <span class="nav-text">
                    Product
                </span>
                <i class="icon-angle-right"></i><i class="icon-angle-down"></i>
            </a>
            <ul>
                <li>
                    <a class="subnav-text" href="{!! route('product.create') !!}">
                        Add Product
                    </a>
                </li>
                <li>
                    <a class="subnav-text" href="{!! route('product.index') !!}">
                        Product List
                    </a>
                </li>
                <li class="has-subnav">
                    <a class="subnav-text" href="{!! route('product_review.index') !!}">
                        Product Reviews
                    </a>
                </li>
                <!-- <li>
                    <a class="subnav-text" href="{!! route('product.import') !!}">
                        Import Products
                    </a>
                </li>
                <li>
                    <a class="subnav-text" href="{!! route('get_product') !!}">
                        Get Products
                    </a>
                </li> -->
            </ul>
        </li>

        <li class="has-subnav">
            <a href="javascript:;">
                <i class="fa fa-list-alt" aria-hidden="true"></i>
                <span class="nav-text">
                    Group
                </span>
                <i class="icon-angle-right"></i><i class="icon-angle-down"></i>
            </a>
            <ul>
                <li>
                    <a class="subnav-text" href="{!! route('group.create') !!}">
                        Add Group
                    </a>
                </li>
                <li>
                    <a class="subnav-text" href="{!! route('group.index') !!}">
                        Group List
                    </a>
                </li>
                <!-- <li>
                    <a class="subnav-text" href="{!! route('product.import') !!}">
                        Import Products
                    </a>
                </li>
                <li>
                    <a class="subnav-text" href="{!! route('get_product') !!}">
                        Get Products
                    </a>
                </li> -->
            </ul>
        </li>

        <li class="has-subnav">
            <a href="javascript:;">
                <i class="fa fa-list-alt" aria-hidden="true"></i>
                <span class="nav-text">
                    CMS
                </span>
                <i class="icon-angle-right"></i><i class="icon-angle-down"></i>
            </a>
            <ul>
                <li class="has-subnav">
                    <a class="subnav-text" href="{!! route('blog.create') !!}">
                        Add Blog
                    </a>
                </li>
                <li>
                    <a class="subnav-text" href="{!! route('blog.index') !!}">
                        Blog Listing
                    </a>
                </li>

                <li>
                    <a class="subnav-text" href="{!! route('blog_comment.index') !!}">
                        Blog Comment Listing
                    </a>
                </li>
             
            </ul>
        </li>

        <li>
            <a href="{!! route('sidebar_category.create') !!}">
                <i class="fa fa-home nav_icon"></i>
                <span class="nav-text">
                    Sidebar Category
                </span>
            </a>
        </li>

        <li>
            <a href="{!! route('product_query.index') !!}">
                <i class="fa fa-home nav_icon"></i>
                <span class="nav-text">
                    Product Queries
                </span>
            </a>
        </li>

        <li>
            <a href="{!! route('request_quote.index') !!}">
                <i class="fa fa-home nav_icon"></i>
                <span class="nav-text">
                    Request Quotes
                </span>
            </a>
        </li>

        <li>
            <a href="{!! route('enquiry.index') !!}">
                <i class="fa fa-home nav_icon"></i>
                <span class="nav-text">
                    Contact Us Enquiry
                </span>
            </a>
        </li>

        <li class="has-subnav">
            <a href="javascript:;">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span class="nav-text">
                    FAQ's
                </span>
                <i class="icon-angle-right"></i><i class="icon-angle-down"></i>
            </a>
            <ul>
                <li>
                    <a class="subnav-text" href="{!! route('faq.create') !!}">
                        Add Faq
                    </a>
                </li>
                <li>
                    <a class="subnav-text" href="{!! route('faq.index') !!}">
                        Faq Listing
                    </a>
                </li>
            </ul>
        </li>
        
        
    </ul>
    <ul class="logout">
        <li>
            <a href="{!! route('admin-logout') !!}">
                <i class="icon-off nav-icon"></i>
                <span class="nav-text">
                    Logout
                </span>
            </a>
        </li>
    </ul>
</nav>