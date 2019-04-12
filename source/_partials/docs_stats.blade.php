@if($page->stats)
    <div class="field is-grouped is-grouped-multiline">
        <div class="control">
            <div class="tags has-addons">
                <span class="tag">since</span>
                <span class="tag is-info">{{ $page->stats['version'] }}</span>
            </div>
        </div>

        <div class="control">
            <div class="tags has-addons">
                <span class="tag">Data API</span>
                @if($page->stats['data_api'])
                    <span class="tag is-success">Yes</span>
                @else
                    <span class="tag is-danger">No</span>
                @endif
            </div>
        </div>

        <div class="control">
            <div class="tags has-addons">
                <span class="tag">Javascript API</span>
                @if($page->stats['javascript_api'])
                    <span class="tag is-success">Yes</span>
                @else
                    <span class="tag is-danger">No</span>
                @endif
            </div>
        </div>
    </div>
@endif