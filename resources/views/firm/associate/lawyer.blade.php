<html>

<head>
    <title>View Law Firm Results</title>
</head>

<body>
<table border = 1>
    <tr>
        <td>Name</td>
        <td>Email</td>
        <td>contact1</td>
        <td>contact2</td>
        <td>area</td>
        <td>city</td>
        <td>street_address</td>
        <td>description</td>
    </tr>
    @foreach ($results as $firm)
        <tr>
            <td>{{ $firm->name }}</td>
            <td>{{ $firm->email }}</td>
            <td>{{ $firm->contact1 }}</td>
            <td>{{ $firm->contact2 }}</td>
            <td>{{ $firm->area }}</td>
            <td>{{ $firm->city }}</td>
            <td>{{ $firm->street_address }}</td>
            <td>{{ $firm->description }}</td>

        </tr>
    @endforeach
</table>
</body>
</html>
