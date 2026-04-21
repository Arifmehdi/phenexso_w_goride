<div class="card mb-2 shadow-lg">
    <div class="card-header py-2">
        <h3 class="card-title w3-small text-bold text-muted pt-1"><i
        class="fas fa-sitemap text-primary"></i> Order Details (OrderId: &nbsp;  {{$order->id }})</h3>
        <div class="card-tools w3-small">
            <a class="btn btn-primary btn-xs" target="_blank" href="{{ route('admin.orderPrint', $order->id) }}"><i class="fas fa-print w3-small"></i> Print</a>
        </div>
    </div>
</div>