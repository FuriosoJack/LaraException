@if ($errors->any())
    @if($errors->has('message'))
        {{$errors->first('message')}}
    @endif
@endif

<style>
</style>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-center">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title red-text"><i class="fa fa-exclamation-triangle " aria-hidden="true"></i> Error {{$errors->first('debugCode')}}</h1>
                    <p>
                        <img  class="img-fluid" alt="Responsive image" src="{{asset('img/gif/error/Dino.gif')}}"/>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>