@extends('layouts.app')
@section('title')
    {{ 'Services Contact | Web Builder IT ' }}
@endsection

@section('content')
    <!-- services contact secction -->
    <section class="services-contact">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 mx-auto">
                    <div class="card p-5">
                        <h4 class="pb-5 text-center"> CONTACT OUR EXPERTS DEVELOPER</h4>
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
            </div>
        </div>

    </section>
@endsection
