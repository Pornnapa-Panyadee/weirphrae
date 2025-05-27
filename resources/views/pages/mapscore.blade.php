<table border="1">
    <tr>
        <th>id</th>
        <th>weir_id</th>
        <th>weir_code</th>
        <th>damage_1</th>
        <th>damage_2</th>
        <th>damage_3</th>
        <th>damage_4</th>
        <th>damage_5</th>
        <th>damage_6</th>
        <th>damage_score_1</th>
        <th>damage_score_2</th>
        <th>damage_score_3</th>
        <th>damage_score_4</th>
        <th>damage_score_5</th>
        <th>damage_score_6</th>
        <th>Amp</th>
        <th>class</th>
        <th>New scoreSum</th>
        <th>New class</th>
        <th>sumScore</th>

    </tr>
    <?php 
         $num =count($result);
        for($i=0;$i<$num;$i++){?>
            <tr>
                <td >{{$i+1}}</td>
                <td>{{$result[$i]['weir_id']}}</td>
                <td>{{$result[$i]['weir_code']}}</td>
                <td>{{$result[$i]['damage_1']}}</td>
                <td>{{$result[$i]['damage_2']}}</td>
                <td>{{$result[$i]['damage_3']}}</td>
                <td>{{$result[$i]['damage_4']}}</td>
                <td>{{$result[$i]['damage_5']}}</td>
                <td>{{$result[$i]['damage_6']}}</td>
                <td>{{$result[$i]['damage_score_1']}}</td>
                <td>{{$result[$i]['damage_score_2']}}</td>
                <td>{{$result[$i]['damage_score_3']}}</td>
                <td>{{$result[$i]['damage_score_4']}}</td>
                <td>{{$result[$i]['damage_score_5']}}</td>
                <td>{{$result[$i]['damage_score_6']}}</td>
                <td>{{$amp}}</td>
                <td>{{$result[$i]['classSum']}}</td>
                <td>{{$result[$i]['new_sumScoreAll']}}</td>
                <td>{{$result[$i]['new_classSum']}}</td>
                <td>{{$result[$i]['sumScore']}}</td>
            </tr>
        <?php } ?>

</table>