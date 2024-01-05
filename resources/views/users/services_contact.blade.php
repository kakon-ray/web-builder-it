@extends('layouts.app')
@section('title')
    {{ 'Services Contact | Web Builder IT ' }}
@endsection

@section('content')
    <!-- services contact secction -->
    <section class="services-contact">
        <div class="container">
            <div class="row">

                <div class="col-lg-6">
                    <div class="card p-5">
                        <div class="text-center pb-3">
                            <h4 class="pb-2 heading"> CONTACT OUR EXPERTS DEVELOPER</h4>
                        </div>

                        <form action="{{ route('user.services.message.submit') }}" id="servicesalert" method="POST">
                            @csrf
                            <!-- Name input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" id="name_lebel_services" for="form4Example1">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" />
                            </div>

                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" id="phone_serives_lebel" for="phone_services_lebel">Mobile
                                    Number</label>
                                <input type="phone" name="phone" required class="form-control"
                                    placeholder="Mobile Number" />
                            </div>

                            <!-- Course Name -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form4Example2">Services Name</label>
                                <select class="form-select" id="services_name" name="services_name"
                                    aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="Complete Website">Complete Website</option>
                                    <option value="Web Design">Web Design</option>
                                    <option value="Web Development">Web Development</option>
                                    <option value="Laravel + Bootstrap + Ajax + Jquery">Laravel + Bootstrap + Ajax + Jquery
                                    </option>
                                    <option value="React + Laravel">React + Laravel</option>
                                    <option value="React + Node">React + Node</option>
                                    <option value="Vue + Laravel">Vue + Laravel</option>
                                    <option value="Wordpress">Wordpress</option>
                                    <option value="UI/UX Deisgn">UI/UX Deisgn</option>
                                    <option value="Grapic Design">Grapic Design</option>
                                    <option value="Digital Marketing">Digital Marketing</option>
                                    <option value="Office Application">Office Application</option>
                                </select>
                            </div>

                            <!-- Message input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form4Example3">Message</label>
                                <textarea class="form-control" name="message" rows="4" placeholder="Message"></textarea>
                            </div>


                            <!-- Submit button -->
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="common-btn btn-block mb-4">Send</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card my-1 p-4">
                                <address>
                                    Contact: +8801707500512<br />
                                    Office Location: Nirala Mor, Khulna

                                </address>
                            </div>
                        </div>
                    </div>
                    <!--Google map-->
                    <div id="map-container-google-2">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29424.01342927033!2d89.5338316883197!3d22.802401689040643!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ff8ff9603b90bf%3A0xbd8858d11188c418!2zTmlyYWxhIE1vcmUsIOCmluCngeCmsuCmqOCmvg!5e0!3m2!1sbn!2sbd!4v1704436117921!5m2!1sbn!2sbd"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>

                    <!--Google Maps-->
                </div>
            </div>
        </div>

    </section>
@endsection
