// Use Morris.Area instead of Morris.Line
Morris.Donut({
    element: 'graph-donut',
    data: [
        {value: 40, label: 'Clientes', formatted: 'at least 70%' },
        {value: 30, label: 'Donaciones', formatted: 'approx. 15%' },
        {value: 20, label: 'Cotizaciones', formatted: 'approx. 10%' },
        {value: 10, label: 'Órdenes', formatted: 'at most 99.99%' }
    ],
    backgroundColor: false,
    labelColor: '#fff',
    colors: [
        '#4acacb','#6a8bc0','#5ab6df','#fe8676'
    ],
    formatter: function (x, data) { return data.formatted; }
});