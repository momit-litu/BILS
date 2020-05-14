@php
    if(\Session::get('locale') == 'en') \App::setLocale('en');
    else 							    \App::setLocale('bn');
@endphp

<style>
.swiper-container {
  width: 100%;
  height: auto;
}
.swiper-slide {
  background: #fff;

  /* Center slide text vertically */
  display: -webkit-box;
  display: -ms-flexbox;
  display: -webkit-flex;
  display: flex;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  -webkit-justify-content: center;
  justify-content: center;
  -webkit-box-align: center;
  -ms-flex-align: center;
  -webkit-align-items: center;
  align-items: center;
}
</style>
<div class="panel panel-default border-none">
	<div class="panel-heading">
		<i class=" fa fa-file-text "></i>
		{{__('app.Course')}}
		<div class="panel-tools">			
			<a class="btn btn-xs btn-link panel-refresh" href="#" onclick="pageLoad('course')">
				<i class="fa fa-refresh"></i>
			</a>
		</div>
	</div>
	<div class="panel-body panel-scroll ps-container ps-active-y fixed-panel">

		<div class="well well-lg">
			<h4>BILS appritiates you !!!!</h4>
			Lorem ipsum dolor sit amet Lorem ier molestie loremtie lorem at massa Integer molestie lorem at massa.
		</div>
		 <div class="swiper-container">
			<div class="swiper-wrapper">
			  <div class="swiper-slide">
					<div class="alert alert-block alert-info fade in">
						<button data-dismiss="alert" class="btn btn-success btn-sm " type="button">
							Interested?
						</button>
						<button data-dismiss="alert" class="btn btn-danger btn-sm pull-right" type="button">
							No?
						</button>
						<br><br>
						<h4> Basic course of fire survey  </h4>
						<dl>
							<button type="button" class="btn btn-primary btn-xs" disabled="disabled">Category name</button>
							<dt>
								Description lists
							</dt>
							<dd>
								A description list is perfect for defining terms.
							</dd>
							<dt>
								Euismod
							</dt>
						</dl>
						<h4> Time Duration </h4>
						<dl class="dl-horizontal">
							<dt>
								Description lists
							</dt>
							<dd>
								A description list is perfect for defining terms.
							</dd>
							<dt>
								Euismod
							</dt>
						</dl> 
						<p>
							<a href="#" class="btn btn-blue">
								Course Details <i class="fa fa-arrow-circle-right"></i>
							</a>
							<a href="#" class="btn btn btn-light-grey">
								Registration
							</a>
						</p>
					</div>
			  </div>
			  <div class="swiper-slide">
					<div class="alert alert-block alert-info fade in">
						<button data-dismiss="alert" class="btn btn-success btn-sm" type="button">
							Interested?
						</button>
						<button data-dismiss="alert" class="btn btn-danger btn-sm" type="button">
							No?
						</button>
						<h4> Vertical description </h4>
						<dl>
							<dt>
								Description lists
							</dt>
							<dd>
								A description list is perfect for defining terms.
							</dd>
							<dt>
								Euismod
							</dt>
						</dl>
						<h4> Horizontal description </h4>
						<dl class="dl-horizontal">
							<dt>
								Description lists
							</dt>
							<dd>
								A description list is perfect for defining terms.
							</dd>
							<dt>
								Euismod
							</dt>
						</dl>
						<p>
							<a href="#" class="btn btn-blue">
								Take this action
							</a>
							<a href="#" class="btn btn btn-light-grey">
								Or do this
							</a>
						</p>
					</div>
			  </div>
			  <div class="swiper-slide">
				<div class="panel-body">
					<h4> Vertical description </h4>
						<dl>
							<dt>
								Description lists
							</dt>
							<dd>
								A description list is perfect for defining terms.
							</dd>
							<dt>
								Euismod
							</dt>
						</dl>
						<h4> Horizontal description </h4>
						<dl class="dl-horizontal">
							<dt>
								Description lists
							</dt>
							<dd>
								A description list is perfect for defining terms.
							</dd>
							<dt>
								Euismod
							</dt>
						</dl>
					</div>
			  </div>
			</div>
			<!-- Add Arrows -->
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
		  </div>
		
	</div>
</div>


<script src="{{-- asset('assets/js/bils/admin/user.js')--}}"></script>
<script>
$(document).ready(function(){
	var swiper = new Swiper('.swiper-container', {
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
});
</script>


