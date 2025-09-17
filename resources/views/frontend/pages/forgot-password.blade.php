@extends('frontend.master')
@section('content')
    <!-- Inner -->
    <section class="inner bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <div class="inner_block customer-screen forget-pw">
                        <h3 class="pb-4 CircularStd-Black">Forget Password</h3>
                        <form>
                            <label>ENTER YOUR EMAIL ID</label>
                            <input type="text" name="" class="form-control">
                            <button type="submit" class="btn btn-support btn-lg mt-4 px-4 CircularStd-Black">Send Link <i class="las la-arrow-right"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-12 col-md-8 text-center">
                    <div class="account-link p-lg-5">
                        <h4 class="mb-0">Dont Have an Account ?</h4>
                        <a href="#" class="view-green font-weight-bold"><u>Create New Account</u></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Inner -->


    <!-- Inner -->
    <section class="planningsec py-4 inner-pages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10">
                    <div class="inner_block text-center">
                        <h1 class="CircularStd-Black text-primary mb-0">List a task needs for your own offer  <button class="btn get-started text-white btn-lg ml-md-3">Get Started</button></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Inner -->
@endsection