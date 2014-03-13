<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">{{$dream->name}}</h4>
    <small></small>
</div>
<div class="modal-body">
<div class="bs-example">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
        <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
        <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
      </ol>
      <div class="carousel-inner">
        @foreach ($dream->pictures as $i=>$p) 
            <div class="item @if($i == 0) {{'active'}} @endif">
              <img data-src="holder.js/900x500/auto/#555:#333/text:Third slide" alt="Third slide" src="{{URL::to($p->picture->url())}}">
            </div>
        @endforeach
        
      </div>
      <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
      </a>
    </div>
  </div>
  </div>