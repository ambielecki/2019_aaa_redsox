<div class="row" id="event_app">
    <div class="col s12 m6 offset-m3">
        <div class="card">
            <div class="card-content">
                <span class="card-title">{{ $title }}</span>
                <div class="row">
                    <form class="col s12" action="{{ $route }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="input-field col s12 m6">
                                <select id="type" name="type" class="material_select">
                                    <option value="" disabled {{ !old('type', $event->type) ? 'selected' : '' }}>Select Event Type</option>
                                    @foreach (\App\Models\Event::TYPE_DESCRIPTIONS as $type => $description)
                                        <option value="{{ $type }}" {{ old('type', $event->type) === $type ? 'selected' : ''}}>{{ $description }}</option>
                                    @endforeach
                                </select>
                                <label for="type">Type</label>
                                @if ($errors->has('type'))
                                    <span class="red-text">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="input-field col s12 m6">
                                <input id="location" name="location" type="text" value="{{ old('location', $event->location) }}">
                                <label for="location">Location</label>
                                @if ($errors->has('location'))
                                    <span class="red-text">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row" id='team_div' style="display: none">
                            <div class="input-field col s12 m12">
                                <select
                                    v-model="division"
                                    v-on:change="getTeamList"
                                    id="details_division"
                                    name="details[division]"
                                    class="material_select"
                                >
                                    <option value="" disabled {{ !old('details.division_id', $event->details['division_id'] ?? '') ? 'selected' : '' }}>Select Division</option>
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}" {{ old('details.division_id', $event->details['division_id'] ?? '') === $division->id ? 'selected' : '' }}>{{ $division->name }}</option>
                                    @endforeach
                                </select>
                                <label for="details_division">Division</label>
                                @if ($errors->has('details.division'))
                                    <span class="red-text">
                                        <strong>{{ $errors->first('details.division') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="input-field col s12 m6">
                                <select id="details_home" name="details[home]" class="material_select">
                                    <option value="" disabled {{ !old('details.home', $event->details['home'] ?? '') ? 'selected' : '' }}>Select Home Team</option>
                                    <option v-for="team in teams" v-bind:value="team.id">@{{ team.name }}</option>
                                </select>
                                <label for="details_home">Home Team</label>
                                @if ($errors->has('details.home'))
                                    <span class="red-text">
                                        <strong>{{ $errors->first('details.home') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="input-field col s12 m6">
                                <select id="details_away" name="details[away]" class="material_select">
                                    <option value="" disabled {{ !old('details.away', $event->details['away'] ?? '') ? 'selected' : '' }}>Select Away Team</option>
                                    <option v-for="team in teams" v-bind:value="team.id">@{{ team.name }}</option>
                                </select>
                                <label for="details_away">Away Team</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12 m6">
                                <input type="text" id="date" name="date" class="datepicker">
                                <label for="date">Date</label>
                                @if ($errors->has('date'))
                                    <span class="red-text">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="input-field col s12 m6">
                                <input type="text" id="time" name="time" class="timepicker">
                                <label for="time">Time</label>
                                @if ($errors->has('time'))
                                    <span class="red-text">
                                        <strong>{{ $errors->first('time') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12">
                                <button class="btn waves-effect waves-light" type="submit" name="action">{{ $button_text }}
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> {{-- End Form Column--}}
</div>

<script>
    Event = JSON.parse('{!! json_encode($event) !!}');
    Old = JSON.parse('{!! json_encode(old()) !!}');
</script>
