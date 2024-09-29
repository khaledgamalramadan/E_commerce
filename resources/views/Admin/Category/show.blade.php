@extends('Admin.master')

@section('title')
    {{ trans('title_page.Show_category') }}
@endsection

@section('main_title')
    {{ trans('content.Show_category') }}
@endsection

@section('breadcrumb_title1')
    {{ trans('content.Home') }}
@endsection

@section('breadcrumb_title2')
    {{ trans('content.Show_category') }}
@endsection

@section('content')
    <div class="card-body">
        @if(session('error_catch'))
            <div class="bg-danger">{{ session('error_catch') }}</div>
        @endif

        <form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col">
                    <label for="name_ar">{{ trans('category_trans.name_ar') }}</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name_ar" value="{{ $category->getTranslation('name', 'ar') }}" readonly>
                    </div>
                </div>
                <div class="col">
                    <label for="name_en">{{ trans('category_trans.name_en') }}</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name_en" value="{{ $category->getTranslation('name', 'en') }}" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="slug">{{ trans('category_trans.slug') }}</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="slug" value="{{ $category->slug }}" readonly>
                    </div>
                </div>
                <div class="col">
                    <label for="image">{{ trans('category_trans.Image') }}</label>
                    <div class="input-group mb-3">
                        <img src="{{ asset('uploads/' . $category->image) }}" alt="Category Image" style="max-width: 200px; max-height: 200px;">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="description_ar">{{ trans('category_trans.description_ar') }}</label>
                    <div class="input-group mb-3">
                        <textarea name="description_ar" rows="3" class="form-control" readonly>{{ $category->getTranslation('description', 'ar') }}</textarea>
                    </div>
                </div>
                <div class="col">
                    <label for="description_en">{{ trans('category_trans.description_en') }}</label>
                    <div class="input-group mb-3">
                        <textarea name="description_en" rows="3" class="form-control" readonly>{{ $category->getTranslation('description', 'en') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="is_showing">{{ trans('category_trans.is_showing') }}</label>
                    <div class="input-group mb-3">
                        @if ($category->is_showing == 1)
                        <span class="badge badge-success">{{ trans('category_trans.showing') }}</span>
                        @else
                        <span class="badge badge-danger">{{ trans('category_trans.hidden') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col">
                    <label for="is_populer">{{ trans('category_trans.popular') }}</label>
                    <div class="input-group mb-3">
                        @if ($category->is_populer == 1)
                        <span class="badge badge-success">{{ trans('category_trans.popular') }}</span>
                        @else
                        <span class="badge badge-danger">{{ trans('category_trans.no_popular') }}</span>
                        @endif                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="meta_title_ar">{{ trans('category_trans.meta_title_ar') }}</label>
                    <div class="input-group mb-3">
                        <input type="text" name="meta_title_ar" class="form-control" value="{{ $category->getTranslation('meta_title', 'ar') }}" readonly>
                    </div>
                </div>
                <div class="col">
                    <label for="meta_title_en">{{ trans('category_trans.meta_title_en') }}</label>
                    <div class="input-group mb-3">
                        <input type="text" name="meta_title_en" class="form-control" value="{{ $category->getTranslation('meta_title', 'en') }}" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="meta_description_ar">{{ trans('category_trans.meta_description_ar') }}</label>
                    <div class="input-group mb-3">
                        <textarea name="meta_description_ar" rows="3" class="form-control" readonly>{{ $category->getTranslation('meta_description', 'ar') }}</textarea>
                    </div>
                </div>
                <div class="col">
                    <label for="meta_description_en">{{ trans('category_trans.meta_description_en') }}</label>
                    <div class="input-group mb-3">
                        <textarea name="meta_description_en" rows="3" class="form-control" readonly>{{ $category->getTranslation('meta_description', 'en') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="meta_keywords">{{ trans('category_trans.meta_keyword') }}</label>
                    <span class="text-danger">{{ trans('category_trans.meta_keyword_note') }}</span>
                    <div class="input-group mb-3">
                        <textarea name="meta_keywords" rows="3" class="form-control" readonly>{{ $category->meta_keywords }}</textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('style')
@endsection

@section('scripts')
@endsection
