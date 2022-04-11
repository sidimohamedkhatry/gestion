<table>
    <thead>
    <tr>
        <th>Nom</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
    @foreach($invoices as $invoice)
        <tr>
            <td>{{ $invoice->name }}</td>
            <td>{{ $invoice->purches_price }}</td>
        </tr>
    @endforeach
    </tbody>
</table>