<h2>Nearest Area Data</h2> 
<table class="table table-bordered">  
    <tr>
        <td>
            <h2> latitude </h2>
        </td>
        <td>
            <h2> longitude </h2>
        </td>
        <td>
            <h2> distance_miles </h2>
        </td>
    </tr>
    <tr>
        <td>
            <h2> <?= $data['data']->nearest_area['0']->latitude; ?> </h2>
        </td>
        <td>
            <h2> <?= $data['data']->nearest_area['0']->longitude; ?> </h2>
        </td>
        <td>
            <h2> <?= $data['data']->nearest_area['0']->distance_miles; ?> </h2>
        </td>
    </tr>
</table>
