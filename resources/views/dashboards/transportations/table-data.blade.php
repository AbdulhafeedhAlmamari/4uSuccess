<thead>
    <tr>
        <th scope="col">#</th>
        @foreach ($headers as $header)
            <th scope="col">{{ $header }}</th>
        @endforeach
    </tr>
</thead>
<tbody>
    @php
        $counter = 1;
    @endphp
    @foreach ($data as $row)
        <tr>
            <th>{{ $counter }}</th>
            <th>
                <div class="d-flex">
                    <img src="{{ asset('build/assets/images/' . $row['consultant_image']) }}" alt="img"
                        class="consult-img rounded" style="width: 50px; height: 50px;">
                    <div class="ms-2">
                        <p class="consult-name m-0">{{ $row['consultant_name'] }}</p>
                        <p class="consult-job">{{ $row['consultant_job'] }}</p>
                    </div>
                </div>
            </th>
            <td>{{ $row['date'] }}</td>
            <td>{{ $row['specialization'] }}</td>
            <td>{{ $row['student_name'] }}</td>
            <td>{{ $row['status'] }}</td>
            <td>
                <i class="far fa-eye" data-bs-toggle="modal" data-bs-target="#requestModal"></i>
            </td>
        </tr>
        @php
            $counter++;
        @endphp
    @endforeach
</tbody>
