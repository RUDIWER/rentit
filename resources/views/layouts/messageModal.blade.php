<!-- MODAL FORM -->

    <!-- Modal -->
<div class = "rw-alert">
    <div class="modal fade" id="rw-message-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('rw_products.attention')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               {{ $slot }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary pull-right" data-dismiss="modal"> {{__('rw_products.no')}}</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL -->
