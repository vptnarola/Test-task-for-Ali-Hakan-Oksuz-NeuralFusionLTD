@extends('panel.layout.app')
@section('title', __('Add or Edit Adsense'))
@section('additional_css')
@endsection
@section('content')
    <div class="page-header" xmlns="http://www.w3.org/1999/html">
        <div class="container-xl">
            <div class="row g-2 items-center">
                <div class="col">
					<div class="hstack gap-1">
						<a href="{{ LaravelLocalization::localizeUrl( route('dashboard.index') ) }}" class="page-pretitle flex items-center">
							<svg class="!me-2 rtl:-scale-x-100" width="8" height="10" viewBox="0 0 6 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path d="M4.45536 9.45539C4.52679 9.45539 4.60714 9.41968 4.66071 9.36611L5.10714 8.91968C5.16071 8.86611 5.19643 8.78575 5.19643 8.71432C5.19643 8.64289 5.16071 8.56254 5.10714 8.50896L1.59821 5.00004L5.10714 1.49111C5.16071 1.43753 5.19643 1.35718 5.19643 1.28575C5.19643 1.20539 5.16071 1.13396 5.10714 1.08039L4.66071 0.633963C4.60714 0.580392 4.52679 0.544678 4.45536 0.544678C4.38393 0.544678 4.30357 0.580392 4.25 0.633963L0.0892856 4.79468C0.0357141 4.84825 0 4.92861 0 5.00004C0 5.07146 0.0357141 5.15182 0.0892856 5.20539L4.25 9.36611C4.30357 9.41968 4.38393 9.45539 4.45536 9.45539Z"/>
							</svg>
							{{__('Back to dashboard')}}
						</a>
						<a href="{{route('dashboard.adsense.index')}}" class="page-pretitle flex items-center">
							/ {{__('Adsense')}}
						</a>
					</div>
                    <h2 class="page-title mb-2">
                        {{__('Add or Edit Adsense')}}
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body pt-6">
        <div class="container-xl">
			<div class="row">
				<div class="col-md-8 mx-auto">
					<form id="adsense_form" onsubmit="return adsenseSave({{ $adsense?->id }});" action="" enctype="multipart/form-data">
						<div class="mb-[20px]">
							<label class="form-label" for="name">
								{{__('Name')}}
								<x-info-tooltip text="{{__('Add a adsense name.')}}" />
							</label>
							<input type="text" class="form-control" id="name" name="name" value="{{ $adsense?->name }}" />
						</div>

						<div class="mb-[20px]">
							<label class="form-label" for="url">
								{{__('URL')}}
								<x-info-tooltip text="{{__('Add a ads redirect URL link. Example: https://google.com/')}}" />
							</label>
							<input type="url" class="form-control" id="url" name="url" value="{{ $adsense?->url }}" />
						</div>

						<div class="mb-[20px]">
							<label class="form-check form-switch" for="status">
								<input class="form-check-input" type="checkbox" id="status" {{ $adsense?->status ? 'checked' : '' }} />
								<span class="form-check-label">{{ __('Adsense Status') }}</span>
								<x-info-tooltip text="{{__('You can disable or enable this adsense. When this option is disabled, the ads will be not visible.')}}" />
							</label>
						</div>

						<div class="mb-[20px]">
							<div class="row mb-4">
								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label" for="banner-width">
											{{__('Width')}}
											<x-info-tooltip text="{{__('Width should be in pixel size. Example: 250')}}" />
										</label>
										<input type="number" class="form-control" id="banner-width" name="banner_width" value="{{ $adsense?->banner_width }}" />
									</div>
								</div>

								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label" for="banner-height">
											{{__('Height')}}
											<x-info-tooltip text="{{__('Height should be in pixel size. Example: 250')}}" />
										</label>
										<input type="number" class="form-control" id="banner-height" name="banner_height" value="{{ $adsense?->banner_height }}" />
									</div>
								</div>

								<div class="col-md-12 mb-3">
									<div class="mb-4">
										<label class="form-label" for="banner-image">{{__('Ads Image')}}</label>
										<input type="file" class="form-control" id="banner-image" name="banner_image" accept="image/*" />
									</div>
								</div>
								<div @class([
									'hidden' => !$adsense?->banner_image,
									'col-md-12 mb-3',
								])>
									<div class="mb-4" id="banner-image-wrapper">
										<img src="{{ $adsense?->image }}" alt="" id="banner-image-preview" />
									</div>
								</div>
							</div>
						</div>
						<button form="adsense_form" id="adsense_button" class="btn btn-primary !py-3 w-100">
							{{__('Save')}}
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script src="/assets/js/panel/adsense.js"></script>
@endsection

