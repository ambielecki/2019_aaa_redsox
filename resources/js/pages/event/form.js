document.addEventListener('DOMContentLoaded', function() {
    let event_type = document.querySelector('#type').value;
    if (event_type === 'game') {
        document.querySelector('#team_div').style.display = 'block';
    }

    let timepickers = document.querySelectorAll('.timepicker');
    Materialize.Timepicker.init(timepickers, {});

    let datepickers = document.querySelectorAll('.datepicker');
    Materialize.Datepicker.init(datepickers, {
        format: 'yyyy-mm-dd',
    });

    document.querySelector('#type').addEventListener('change', function (event) {
        let team_div = document.querySelector('#team_div');

        if (event.target.value === 'game') {
            team_div.style.display = 'block';
        } else {
            team_div.style.display = 'none';
        }
    });
});
