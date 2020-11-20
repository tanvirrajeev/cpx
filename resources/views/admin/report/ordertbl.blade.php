                    <table class="table border" id="orderlistadmin">
                        <thead>
                                <th>SHIPPING CODE</th>
                                <th>ECOM ORD NO</th>
                                <th>AWB</th>
                                <th>STATUS</th>
                                <th>CREATED AT</th>
                        </thead>
                        <tbody>
                            @foreach ($ord as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->ecomordid}}</td>
                                    <td>{{$item->awb}}</td>
                                    <td>{{$item->statusname}}</td>
                                    <td>{{$item->created_at}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

