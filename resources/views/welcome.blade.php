@extends("layouts.app")

@section('content')
    @if(count($result))
        <?php
        function cmp($a, $b)
        {
            if ($a->cosin == $b->cosin) {
                return 0;
                }
                return ($a->cosin > $b->cosin) ? -1 : 1;
            }
            usort($result, "cmp");

        ?>
        <div class="row align-items-center">
            <div class="col-lg-5 about-right">
                <h1>
                    Search Result: <span class="text text-success"> {{ count($result)}} </span>
                </h1>

            </div>
            <div class="offset-lg-1 col-lg-6">
                <div class="courses-right">
                    <h3 class="text text-danger">
                        <?php
                            $arr = array();
                            foreach ($result as $r)
                                array_push($arr, $r->path);

                            $arr1 = array();
                            foreach (App\Document::all() as $d)
                                array_push($arr1, $d->path);
                            echo '
                                Precision = '.count(array_intersect($arr, $arr1))/count($arr1).'<br>
                                Recall = '.count(array_intersect($arr, $arr1))/count($arr).'<br>
                            ';
                        ?>

                    </h3>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <ul class="courses-list">
                                @foreach($result as $r)
                                    <li>
                                        <a class="wow fadeInLeft" href="file:///{{ str_replace("\\", "/",  $r->path)}}" data-wow-duration="1s"
                                           data-wow-delay=".1s" target="_blank">
                                            <i class="fa fa-book"></i><strong class="text text-primary">{{ basename($r->path) }}</strong>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else

    @endif
@endsection