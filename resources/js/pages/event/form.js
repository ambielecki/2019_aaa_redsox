let app = new Vue({
    el: '#event_app',
    data: {
        event: Event,
        old: Old,
        teams: [],
        division: null,
        home_team: null,
        away_team: null,
    },
    methods: {
        getTeamList() {
            Axios.get('/api/team/list', {
                params: {
                    division_id: this.division,
                }
            }).then(function (response) {
                app.teams = response.data.teams;
            }).catch(function (error) {
                console.log(error);
            });
        },
    },
    updated() {
        let selects = document.querySelectorAll('#details_home, #details_away')
        Bielecki.initSelects(selects, {});
    },
});

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
