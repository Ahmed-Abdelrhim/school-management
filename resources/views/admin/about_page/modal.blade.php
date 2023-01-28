<div class="modal fade text-left" id="modalCreate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> {{$item->created_at}}</h4>
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
        </div>

        <div class="modal-body">
            <p>{{$item->multi_image}}</p>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>

    </div>
</div>
