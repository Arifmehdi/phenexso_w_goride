@forelse ($pages as $page)
<div class="card mb-1 shadow" id="{{ $page->id }}">
    <div class="card-body w3-small px-2 py-1">
            <i class="fas fa-arrows-alt-v text-muted" style="cursor: move;"></i>

            @if ($page->active)
                <i class="fas fa-check-square text-success" style="cursor: move;"></i>
            @else
                <i class="far fa-square w3-light-gray" style="cursor: move;"></i>
            @endif

            <span class="text-muted w3-small"> ID:<b>{{ $page->id }}</b>,
              Title: <b>{{ $page->name_en}}</b>
            </span>
            &nbsp;

            <div class="float-right">
                @if ($page->link)
                    <button class="copyboard border-0 badge badge-primary text-white" data-id="{{ $page->id }}"
                        data-text="{{ $page->link }}">
                        Copy url
                    </button>
                    <a target="_blank" href="{{ $page->link }}" class="badge badge-primary">View</a>
                @else
                    <button class="copyboard border-0 badge badge-primary text-white" data-id="{{ $page->id }}"
                    data-text="{{ route('page', $page->slug)}}">
                    Copy url
                    </button>
                    <a target="_blank"
                    href="{{ route('page', $page->slug)}}"
                    class="badge badge-primary">View</a>
                @endif


                <a class="btn btn-primary btn-xs" href="{{route('admin.pageItemCreate',$page->id)}}">
                    Page Parts <small>({{ $page->pageItems()->count() }})</small>
                </a>

                <a title="Edit" class="btn btn-default btn-xs"
                href="{{ route('admin.pageEdit', $page)}}"><i class="fas fa-edit"></i></a>

                @if($page->link)
             
                @else
                    <a title="Delete" onclick="return confirm('Do you really want to delete?');"  onclick="return confirm('Do you really want to delete?')"
                    href="{{ route('admin.pageDelete', ['page' => $page]) }}"><i
                    class="fas fa-times-circle text-danger"></i></a>
                @endif
               
            </div>
        </div>
    </div>
@empty
<div class="text-danger h5 text-center">
    <h3 >No page Found</h3>
</div>
@endforelse