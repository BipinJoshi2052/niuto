<!-- Breadcrumbs -->
<section id="breadcrumbs" class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="m-0 p-0 d-flex align-items-center text-white">
                    <li class="font-weight-bold">Home</li><span class="mx-2"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                    <li class="">Contact Us</li>
                </ul>
            </div>
            <div class="col-12 mt-3">
                <h2 class="text-white">Contact Us</h2>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumbs Ends -->
<!-- Contact Us -->
<section id="contact-us-wrapper" class="p-4">
    <div class="container">
        <div class="row padding px-xl-5 px-lg-5 px-md-4">
            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                <!-- CONTACT INFO -->
                <div class="contact-info d-flex flex-column justify-content-center h-100 text-white">
                    <div class="title mb-3">
                        <h1 class="contact-us-heading">Love To Hear From You</h1>

                        <p class="pt-3"></p>

                    </div>
                    <div class="address-info">
                        <ul>
                            <li class="p-2">
                                <p class="m-0"><i class="fa fa-map-marker mr-1" aria-hidden="true"></i><span> {{ getSetting()['address'] ?? 'Kathmandu, Nepal' }}</span></p>
                            </li>
                            <li class="p-2">
                                <p class="m-0"><i class="fa fa-envelope mr-1" aria-hidden="true"></i> <a href="mailto:{{ getSetting()['email'] ?? '' }}"><span> {{ getSetting()['email'] ?? '' }}</span></a></p>
                            </li>
                            <li class="p-2">
                                <p class="m-0"><i class="fa fa-phone mr-1" aria-hidden="true"></i><a href="tel:{{ getSetting()['phone_number'] ?? '' }}">{{ getSetting()['phone_number'] }}</a></a></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-lg-6 col-md-6 col-12 m-auto">
                <!-- CONTACT FORM HERE -->
                <form class="p-4" id="contactusForm">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" id="first_name" class="form-control">
                    </div> 
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" id="last_name" class="form-control">
                    </div>  
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" id="phone" class="form-control" placeholder="Phone">
                    </div>
                    <div class="form-group">
                        <textarea id="message" class="form-control " rows="4" placeholder="Your Message"></textarea>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="px-5">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Contact Us Ends -->