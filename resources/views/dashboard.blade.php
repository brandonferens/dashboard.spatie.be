@extends('layouts/master')

@section('content')

@javascript(compact('pusherKey', 'pusherCluster', 'usingNodeServer'))

<dashboard id="dashboard" columns="4" rows="3">
    <ics-calendar position="a1:a2"></ics-calendar>
    <music position="b1:c1"></music>
    <uptime position="a3"></uptime>

    <!-- <tasks team-member="alex" position="b2"></tasks> -->
    <!-- <tasks team-member="freek" position="c2"></tasks> -->
    <!-- <tasks team-member="seb" position="b3"></tasks> -->
    <!-- <tasks team-member="willem" position="c3"></tasks> -->

    <jira team-member="brandon" position="b2"></jira>
    <jira team-member="robin" position="c2"></jira>
    <jira team-member="dustin" position="b3"></jira>
    <jira team-member="eric" position="c3"></jira>

    <time-weather position="d1" date-format="ddd M/D"></time-weather>
    <time-weather position="d2" date-format="ddd M/D" city="San Diego"></time-weather>
    <time-weather position="d3" date-format="ddd M/D" city="Kona" timezone="America/Adak"></time-weather>

    <!-- <internet-connection></internet-connection> -->
</dashboard>

@endsection
