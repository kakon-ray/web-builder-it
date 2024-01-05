@extends('layouts.app')
@section('title')
    {{ 'Free Seminer | Web Builder IT ' }}
@endsection

@section('content')
    <!-- free seminer details -->

    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 mb-5 text-center">
                <h2 class="mb-4 heading2">সেমিনারের সময়সূচি</h2>
                <p>কোন কোর্সে ভর্তি হবেন, সেই কোর্সে কাজের সুযোগ কেমন আর ওয়েব বিল্ডার আইটি -তে ভর্তি হলে কি কি সুবিধা
                    পাবেন- আপনার মনে এমন অসংখ্য প্রশ্ন রয়েছে নিশ্চয়ই? আপনার যেকোনো প্রশ্নের সরাসরি উত্তর দিতে প্রতি সপ্তাহে
                    আমরা আয়োজন করি কোর্সভিত্তিক ফ্রি সেমিনার। এই সেমিনারগুলোতে অংশ নিয়ে আপনি কোর্সের মেন্টরের কাছ থেকে কোর্স
                    বিষয়ক যেকোনো পরামর্শ নিতে পারেন।</p>
            </div>

            @foreach ($allSeminar as $item)
                <a href="{{ route('user.course.contact') }}">
                    <div class="col-lg-12">
                        <div class="card m-4 rounded-0">
                            <div class="row">
                                <div class="col-lg-3 p-3 seminer-card">
                                    <h3 class="pt-2">Date: {{ $item->seminer_date }}</h3>
                                </div>
                                <div class="col-lg-8 p-3 px-4">
                                    <h3>{{ $item->seminer_title }} - Online Seminer</h3>
                                    <p>Web Builder IT</p>
                                    <h4>Time: <b> @php echo date("g:i a", strtotime("$item->seminer_time UTC")) @endphp </b></h4>
                                </div>

                                <div class="col-lg-1 p-3 seminer-card">
                                    <span> Confirm </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach






        </div>
    </div>
@endsection
