<!-- Button trigger modal -->
<button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{$data->id}}">
    {{ trans('category_trans.Delete') }}
</button>

<!-- Modal -->
<div class="modal fade" id="deleteModal{{$data->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ trans('messages_trans.Confirm_Delete') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ trans('messages_trans.Are_you_sure_delete') }} <strong>{{ $data->getTranslation('name', 'ar') }}</strong>؟
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trans('category_trans.Close') }}</button>
                <form action="{{ route('categories.destroy', $data->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ trans('category_trans.Delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
