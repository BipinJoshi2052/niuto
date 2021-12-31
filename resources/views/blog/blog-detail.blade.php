@extends('layouts.master')
@section('content')
    <!-- Breadcrumbs -->
    <section id="breadcrumbs" class="py-3">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="m-0 p-0 d-flex align-items-center text-white">
                        <li class="font-weight-bold">Home</li><span class="mx-2"><i class="fa fa-angle-right"
                                aria-hidden="true"></i></span>
                        <li class="">Blog Detail</li>
                    </ul>
                </div>
                <div class="col-12 mt-3">
                    <h2 class="text-white blog_name"></h2>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumbs Ends -->
    <!-- ABOUT Us -->
    <section id="about-us-wrapper" class="py-4">
        <div class="container">
            {{-- <div class="row">
                <div class="col-12 text-center">
                    <div class="about-banner-img mb-3 position-relative">
                        <img src="frontend/assets/images/product-images/1 (2).jpg" class="img-fluid">
                    </div>
                </div>
            </div> --}}
            <div class="about-us-list">
                <div class="row">
                    <div class=" col-xl-12 col-lg-12 col-md-12 order-xl-1 order-lg-1 order-md-1 order-2 mb-2">
                        <div class="about-us-image-discription d-flex h-100 justify-content-center align-items-center flex-column py-3">
                            <p class="blog-detail"></p>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
@section('script')
    <script>
        var slug = "{{ $slug }}";
        var language_id = localStorage.getItem('languageId');
        $(document).ready(function() {
            fetchBlogs();
            fetchBlogCategories();
            fetchFeaturedBlogs();
        });


        function fetchBlogs() {
            $.ajax({
                type: 'get',
                url: "{{ url('') }}" + '/api/client/blog_news?slug=' + slug + '&language_id=' + language_id +
                    '&getGallaryDetail=1&getBlogCategory=1',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {

                    if (data.status == 'Success') {
                        var blogContent = '';
                        if (typeof data.data[0] !== undefined) {
                            $('.blog_name').html(data.data[0].detail[0].name);


                            blogContent +=
                                '<div class="blog-thumbnail"><span class="date-tag badge blog-date">' + data
                                .data[0].date + '</span>';
                            blogContent += '<a href="javascript:void(0)"><img class="img-thumbnail blog-image" src="/gallary/' +
                                data.data[0].gallary.gallary_name + '" width="100%"></a></div>';


                            blogContent += '<h5 class="post-title"><a href="" class="blog-category-link">' +
                                data.data[0].category.blog_detail[0].name + '</a></h5>';
                            blogContent += '<p class="blog-title">' + data.data[0].detail[0].name +
                                '</small></p>';
                            blogContent += '<span class="blog-description">' + data.data[0].detail[0]
                                .description + '</span>';
                        } else {
                            blogContent = 'no content';
                        }
                        $('.blog-detail').html(blogContent);
                    }
                },
                error: function(data) {},
            });
        }



        function fetchBlogCategories() {
            $.ajax({
                type: 'get',
                url: "{{ url('') }}" + '/api/client/blog_category?getGallaryDetail=1&language_id=' +
                    language_id + '&getDetail=1',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {

                    if (data.status == 'Success') {
                        var blogCategory = '';
                        if (data.data.length > 0) {
                            for(var i= 0; i < data.data.length ; i ++){
                                blogCategory +='<a class="main-manu" href="/blog?category='+data.data[i].blog_category_slug+'">';
                                blogCategory += '<img class="img-fuild" src="/gallary/' +
                                data.data[i].blog_category_gallary_id.gallary_name + '">';
                                blogCategory += '<span> '+data.data[i].blog_detail[0].name+'</span </a>';
                            }
                        } else {
                            blogCategory = 'no content';
                        }
                        $('.category-list').html(blogCategory);
                    }
                },
                error: function(data) {},
            });
        }

        function fetchFeaturedBlogs(page) {
            var url = "{{ url('') }}" + '/api/client/blog_news?limit=13&getGallaryDetail=1&getBlogCategory=1&is_featured=1&language_id='+language_id;
            $.ajax({
                type: 'get',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                    clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                },
                beforeSend: function() {},
                success: function(data) {

                    if (data.status == 'Success') {
                        var featuredBlogs = '';
                        for (i = 0; i < data.data.length; i++) {
                            featuredBlogs += '<div class="media">';
                            featuredBlogs += '<div class="media-img">';
                            featuredBlogs += '<img src="/gallary/'+data.data[i].gallary.gallary_name+'">';
                            featuredBlogs += '</div>';
                            featuredBlogs += '<div class="media-body">';
                            featuredBlogs += '<h5>'+data.data[i].detail[0]
                                    .name+'</h5>';
                            featuredBlogs += '<div class="post-date">';
                            featuredBlogs += '<i class="fa fa-calendar" aria-hidden="true"></i>';
                            featuredBlogs += '<a href="javascript:void(0)">'+data.data[i].date+'</a>';
                            featuredBlogs += '</div>';

                            featuredBlogs += '</div>';
                            featuredBlogs += '</div>';
                        }
                        $('.featured-blog').html(featuredBlogs);
                    }
                },
                error: function(data) {},
            });
        }
    </script>
@endsection
