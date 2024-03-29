@extends('panel.layout.app')
@section('title', __('Google Adsense'))

@section('content')
	<div class="page-header">
	    <div class="container-xl">
	        <div class="items-center row g-2">
	            <div class="col">
	                <a href="{{ LaravelLocalization::localizeUrl( route('dashboard.index') ) }}" class="flex items-center page-pretitle">
	                    <svg class="!me-2 rtl:-scale-x-100" width="8" height="10" viewBox="0 0 6 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
	                        <path d="M4.45536 9.45539C4.52679 9.45539 4.60714 9.41968 4.66071 9.36611L5.10714 8.91968C5.16071 8.86611 5.19643 8.78575 5.19643 8.71432C5.19643 8.64289 5.16071 8.56254 5.10714 8.50896L1.59821 5.00004L5.10714 1.49111C5.16071 1.43753 5.19643 1.35718 5.19643 1.28575C5.19643 1.20539 5.16071 1.13396 5.10714 1.08039L4.66071 0.633963C4.60714 0.580392 4.52679 0.544678 4.45536 0.544678C4.38393 0.544678 4.30357 0.580392 4.25 0.633963L0.0892856 4.79468C0.0357141 4.84825 0 4.92861 0 5.00004C0 5.07146 0.0357141 5.15182 0.0892856 5.20539L4.25 9.36611C4.30357 9.41968 4.38393 9.45539 4.45536 9.45539Z"/>
	                    </svg>
	                    {{__('Back to dashboard')}}
	                </a>
	            </div>
	        </div>
	    </div>
	</div>

	<div class="pt-6 page-body">
	    <div class="container-xl">
	        <div class="mb-2 flex justify-between">
	        	<div>
	        		<h2 class="mb-[1em]">
	                    {{__('Google Adsense List')}}
	                </h2>
	        	</div>

	        	<div>
	        		<input type="text" class="form-control" id="adsense-search" onkeyup="search(this)" placeholder="Search..." />
	        	</div>
	        </div>

	        <div class="card">
                <div id="table-default" class="card-table table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{__('Adsense Type')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Updated At')}}</th>
                            <th>{{__('Actions')}}</th>
                        </tr>
                        </thead>
                        <tbody class="align-middle table-tbody text-heading" id="table-adsense">
                            @include('panel.adsense.item', [ 'adsenses' => $adsenses ])
                        </tbody>
                    </table>
                </div>

                <div id="pagination-wrapper">
                    {{ $adsenses->links('pagination::bootstrap-5') }}
                </div>
            </div>

	    </div>
	</div>
@endsection

@section('script')
    <script src="/assets/js/panel/adsense.js"></script>
@endsection
