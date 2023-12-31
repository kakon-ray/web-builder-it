@extends('layouts.app')
@section('title')
    {{ 'Free Seminer | Web Builder IT ' }}
@endsection

@section('content')
    <!-- free seminer details -->

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-9 mx-auto mb-5">
                <h2 class="pb-4">ফ্রি সেমিনারের সময়সূচি</h2>
                <p>কোন কোর্সে ভর্তি হবেন, সেই কোর্সে কাজের সুযোগ কেমন আর উমা আই.টি ইন্সটিটিউট -এ ভর্তি হলে কি কি সুবিধা
                    পাবেন- আপনার মনে এমন অসংখ্য প্রশ্ন রয়েছে নিশ্চয়ই? আপনার যেকোনো প্রশ্নের সরাসরি উত্তর দিতে প্রতি সপ্তাহে
                    আমরা আয়োজন করি কোর্সভিত্তিক ফ্রি সেমিনার। এই সেমিনারগুলোতে অংশ নিয়ে আপনি কোর্সের মেন্টরের কাছ থেকে কোর্স
                    বিষয়ক যেকোনো পরামর্শ নিতে পারেন।</p>
            </div>

            @foreach ($allSeminar as $item)
                <a href="{{ route('user.course.contact') }}">
                    <div class="col-lg-9 mx-auto my-3">
                        <div class="d-flex w-100">
                            <div class="card main-card">
                                <div class="card-body text-center d-flex align-items-center">
                                    <h3 class="pt-2">{{ $item->seminer_date }}</h3>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body px-5 mx-5">
                                    <h3>{{ $item->seminer_title }}</h3>
                                    <p>খুলনা আই.টি হেড অফিস ,</p>
                                    <p>সময়ঃ {{ $item->seminer_time }}</p>
                                </div>
                            </div>

                            <button class="common-btn pt-3 px-5">ফ্রি ক্লাস করতে এখানে ক্লিক করুন </button>
                        </div>
                    </div>
                </a>
            @endforeach






        </div>
    </div>
@endsection
