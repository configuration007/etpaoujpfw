@extends('layouts.index')
@section('css')
    <link href="{{ asset('assets/css/app2.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="cDOidB">
        <div class="jCmOuA">
            <div class="jqlzrh">
                <div class="DKoFv">
                    <div class="eRxyUk">
                        <img src="/assets/images/wallet-buy-phone.png" alt="Buy bitcoin app screenshot"
                            class="wallet__Img-sc-8kz4te-15 eyAnaY">
                    </div>
                    <div class="bJihgW">
                        <form class="saSEAAw" action="{{ url('contact') }}" method="POST">
                            @csrf
                            <h2 class="kPRcAz sdescaA">Contact Us</h2>
                            <div class="aSEasas">
                                <input type="text" class="" placeholder="Email" name="email" required>
                                <input type="text" class="" placeholder="Subject" name="subject" required>
                            </div>
                            <div class="aSEasas">
                                <textarea name="" id="" cols="30" rows="10" class="" name="message"
                                    required>Message ...</textarea>
                            </div>
                            <div class="aSEasas">
                                <button class="fQXoGc ewcSWC">
                                    Send
                                </button>
                            </div>
                        </form>
                        {{-- <a href="contact-us" class="esqbZI"> Learn More
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4.16797 10H15.8346" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M10 4.16797L15.8333 10.0013L10 15.8346" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
