<table style="border: solid lightgray 1px; background-color: transparent; max-width: 450px; margin:  0px auto" cellpadding="0" cellspacing="0">
    <tbody>
        <tr>
            <td>Dear {{$details['user']->name}},<br/>Your subscription email is here.</td>
        </tr>
        <tr>
            <td><h3 style="text-center">Post You Subscribed</h3></td>
        </tr>

        <?php
        foreach ($details['posts'] as $Post) {
            ?>
            <tr>
                <td>
                    <h4>{{$Post->title}}</h4>
                    <p>{{$Post->summary}}</p>
                    <p>Published {{date("d M, Y h:iA",$Post->created_at)}} at {{$Post->getWebsite->website}}</p>
                    <p><a href="{{route('Post.show',$Post->id))}}">View Details</a></p>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>