@extends('layouts.app')
@section('title')
    {{ 'Course Admission | Web Builder IT ' }}
@endsection

@section('content')
    <style>
        .map {
            width: 100%;
            height: 440px;

        }
    </style>
    <!-- course secction -->
    <section class="all-course">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card p-5">
                        <h5 class="pb-4">ফ্রি সেমিনারে অংশগ্রহন করতে এডমিশন ফরম টি পূরন করুন</h5>
                        <form action="{{ route('user.course.message.submit') }}" id="courseadmissionalert" method="POST">
                            @csrf
                            <!-- Name input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form4Example1">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" />
                            </div>

                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" id="phone_lebel" for="form4Example2">Mobile Number</label>
                                <input type="phone" name="phone" required class="form-control"
                                    placeholder="Mobile Number" />
                            </div>

                            <!-- Course Name -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form4Example2">Course Name</label>
                                <select class="form-select" name="course_name" id="course_name"
                                    aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="Web Design">Web Design</option>
                                    <option value="Web Development">Web Development</option>
                                    <option value="Web Development">Wordpress</option>
                                    <option value="UI/UX Deisgn">UI/UX Deisgn</option>
                                    <option value="Grapic Design">Grapic Design</option>
                                    <option value="Grapic Design">SEO</option>
                                    <option value="Digital Marketing">Digital Marketing</option>
                                    <option value="Facebook Marketing">Facebook Marketing</option>
                                    <option value="Youtube Marketing">Youtube Marketing</option>

                                </select>
                            </div>

                            <!-- Message input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form4Example3">Message</label>
                                <textarea class="form-control" name="message" rows="4" placeholder="Message"></textarea>
                            </div>

                            <!-- Submit button -->
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="common-btn mb-4">Send</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card my-1 p-4">
                                <address>
                                    যোগাযোগ: +০১৯৮২৩১১৩০৮<br />
                                    অফিসের ঠিকানাঃ গুড়হাটা, সোনাপটি, নোয়াপাড়া বাজার, যশোর, খুলনা।

                                </address>
                            </div>
                        </div>
                    </div>
                    <!--Google map-->
                    <div id="map-container-google-2">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3677.7087970264574!2d89.5546586141916!3d22.813251729845202!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ff912c073a10e9%3A0x26b79a5e9d0b0dfe!2sKhulna%20IT%20Institute!5e0!3m2!1sen!2sbd!4v1674326292586!5m2!1sen!2sbd"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" class="map"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>

                    <!--Google Maps-->
                </div>
            </div>
        </div>

    </section>
@endsection
