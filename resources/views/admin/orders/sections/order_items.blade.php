  <div class="card shadow">
    <div class="card-header">
        <h3 class="card-title">
        Order Items
        </h3>
    </div>
    <div class="card-body">

        <div id="orderItemsWrapper">
            <table class="table table-bordered">
                {{-- your loop and summary rows --}}
                   @include('admin.orders.includes.items')
            </table>
        </div>
    </div>
</div>