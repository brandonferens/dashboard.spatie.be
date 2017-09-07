@extends('layouts/master')

@section('content')

@javascript(compact('pusherKey', 'pusherCluster', 'usingNodeServer'))

<dashboard id="dashboard" columns="4" rows="3">
    <ics-calendar position="a1:a2"></ics-calendar>
    <music position="b1:c1"></music>
    <uptime position="a3"></uptime>

    <jira team-member="brandon" position="b2"></jira>
    <jira team-member="robin" position="c2"></jira>
    <jira team-member="steph" position="b3"></jira>
    <jira team-member="dustin" position="c3"></jira>

    <time-weather position="d1" date-format="ddd M/D"></time-weather>
    <time-weather position="d2" date-format="ddd M/D" city="San Diego"></time-weather>
    <time-weather position="d3" date-format="ddd M/D" city="Boston" timezone="America/New_York"></time-weather>

    <!-- <internet-connection></internet-connection> -->
</dashboard>

@endsection
