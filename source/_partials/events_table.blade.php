<h1>Events</h1>

<p>These are the events that this plugin emits when various actions happen. These can be listened to by using the <code>on</code> method.</p>

<table class="table is-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Syntax</th>
            <th>Description</th>
        </tr>
    </thead>

    <tbody>
        @foreach($page->events as $event)
            <tr>
                <td>{{ $event[0] }}</td>
                <td><code>{{ $event[1] }}</code></td>
                <td>{{ $event[2] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>