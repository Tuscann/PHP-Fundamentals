let counter = 2;

$(document).ready(function () {
    preventFormSubmit();
    $('#add').on('click', addRow);
    bindEvents();

    $('form').on('submit', function () {
        let ids = [...new Set($('input[type=email]')
            .toArray()
            .map(e => $(e).attr('id').split('-')[1]))];

        $('input[type=hidden]').val(ids);

        return true;
    })
});

function bindEvents() {
    $('.removeRow').on('click', function () {
        $(this).parent().parent().detach();
    })
}

function addRow() {
    counter++;
    let row = $('<tr>')
        .append($('<td>')
            .append($('<input type="text" title="First name" placeholder="First name" required>')
                .attr('name', 'firstName-' + counter)
                .attr('id', 'firstName-' + counter))
        )
        .append($('<td>')
            .append($('<input type="text" title="Last name" placeholder="Last name" required>')
                .attr('name', 'lastName-' + counter)
                .attr('id', 'lastName-' + counter))
        )
        .append($('<td>')
            .append($('<input type="email" title="Email" placeholder="Email" required>')
                .attr('name', 'email-' + counter)
                .attr('id', 'email-' + counter))
        )
        .append($('<td>')
            .append($('<input type="number" min="0" title="Exam score" placeholder="Exam score" required>')
                .attr('name', 'score-' + counter)
                .attr('id', 'score-' + counter))
        )
        .append($('<td>')
            .append($('<button>')
                .addClass('removeRow')
                .text('-'))
        );

    $('table>tbody').append(row);

    preventFormSubmit();
    bindEvents();
}

function preventFormSubmit() {
    $('button').on('click', function (event) {
        event.preventDefault();
    });
}