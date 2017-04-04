@extends('templates.default')
@section('content')
<div class="container">
        <?php $counter = 0; ?>
         @foreach ($certificates as $certificate)
            @if(file_exists(public_path().DIRECTORY_SEPARATOR.$certificate->image))
                    <?php
                    $counter++;
                    if($counter == 1){
                        echo "<div class = 'row'>";
                    }
                    ?>
                    <div class="col-md-3 col-sm-6 col-xs-12  col-lg-3 thumb">
                        <a data-toggle="modal" data-target=".pop-up-{{$certificate->id}}" href="#">
                            <img  class="" src="{{asset($certificate->image)}}" alt="{{$certificate->alt}}">
                        </a>
                    </div>
                    <!--  Modal content for the mixer image example -->
                    <div class="modal fade pop-up-{{$certificate->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <div class="modal-body">
                                    <img src="{{asset($certificate->image)}}" class="img-responsive center-block" alt="">
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal mixer image -->
                        <?php
                        if($counter % 4 == 0){
                            echo "</div>";
                            $counter = 0;
                        }
                        ?>
                    @endif
          @endforeach
</div>
@stop