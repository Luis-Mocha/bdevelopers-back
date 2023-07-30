@extends('layouts.back')


@section('content')
    <section id="sponsorship-section">

        <h1 class="page-title text-center m-0">Sponsorizza te stesso nella nostra vetrina !</h1>

        <div class="card-container d-flex flex-column flex-lg-row align-items-center justify-content-center">

            <div class="card-sponsor">
                <div class="cover item-a">
                    <h2>Silver</h2>
                    <p>Compari tra gli sviluppatori <br> in evidenza per 24 ore</p>
                    <div class="card-back silver">
                        {{-- <a href="{{ url('sponsorships/payment') }}" class="submit" id="submit-button-1" data-amount="2.99" >24 Ore: €2.99</a> --}}
                        <a href="{{ route('token', ['amount' => 2.99]) }}">24 Ore: €2.99</a>
                    </div>
                </div>
            </div>

            <div class="card-sponsor">
                <div class="cover item-b">
                    <h2>Gold</h2>
                    <p>Compari tra gli sviluppatori <br> in evidenza per 72 ore</p>
                    <div class="card-back gold">
                        {{-- <a href="#" class="submit" id="submit-button-2" data-amount="5.99" data-bs-toggle="modal"
                            data-bs-target="#paymentModal">72 Ore: €5.99</a> --}}
                            <a href="{{ route('token', ['amount' => 5.99]) }}">72 Ore: €5.99</a>
                    </div>
                </div>
            </div>
            <div class="card-sponsor">
                <div class="cover item-c">
                    <h2>Platinum</h2>
                    <p>Compari tra gli sviluppatori <br> in evidenza per 144 ore</p>
                    <div class="card-back platinum">
                        {{-- <a href="#" class="submit" id="submit-button-3" data-amount="9.99" data-bs-toggle="modal" data-bs-target="#paymentModal">144 Ore: €9.99</a> --}}
                        <a href="{{ route('token', ['amount' => 9.99]) }}">144 Ore: €9.99</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- @php
            dd($sponsorshipsData)
        @endphp --}}

        <div class="sponsor-recap px-5">
            @if(count($sponsorshipsData) > 0)
                @php
                    $firstSponsorship = $sponsorshipsData->first();
                    $endDate = $firstSponsorship->end_date;
                    $today = now();
                @endphp

                @if($endDate >= $today)
                     @php
                        $endDateCarbon = \Carbon\Carbon::parse($endDate);
                        $formattedDate = $endDateCarbon->format('d/m/Y');
                        $formattedTime = $endDateCarbon->format('H:i');
                    @endphp
                
                    <div class="sponsor-status">Il tuo periodo in evidenza scadrà il {{ $formattedDate }} alle {{ $formattedTime }}.</div>

                @else
                    <div class="sponsor-status">Non hai una sponsorizzazione attiva al momento.</div>
                @endif
            @else
                <div class="sponsor-status">Il profilo non ha mai effettuato una sponsorizzazione.</div>
            @endif

            @if(count($sponsorshipsData) > 0)
                {{-- bottone mostra tutti --}}
                @if(count($sponsorshipsData) > 3)
                    <button id="revealButton">Mostra tutti gli abbonamenti</button>
                @endif

                {{-- Tabella recap --}}
                <table id="recap-table">
                    <thead>
                        <tr>
                            <th>Tipo di sponsor</th>
                            <th>Data di inizio</th>
                            <th>Data di fine</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @foreach ($sponsorshipsData as $elem)
                            <tr>
                                <td>
                                    @if ($elem->sponsorship_id == 1)
                                        Silver
                                    @elseif ($elem->sponsorship_id == 2)
                                        Gold
                                    @else
                                        Platinum
                                    @endif
                                </td>
                                <td>{{$elem->start_date}}</td>
                                <td>{{$elem->end_date}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

        </div> 
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let tableBody = document.getElementById('tableBody');
            let rows = tableBody.getElementsByTagName('tr');
    
            // Nascondi tutte le righe della tabella tranne le prime tre
            for (let i = 3; i < rows.length; i++) {
                rows[i].style.display = 'none';
            }
    
            // Aggiungi l'evento click al pulsante "Rivela tutte le righe"
            document.getElementById('revealButton').addEventListener('click', function () {
                // Mostra tutte le righe nascoste
                for (let i = 3; i < rows.length; i++) {
                    rows[i].style.display = (rows[i].style.display === 'none') ? 'table-row' : 'none';
                }
            });
        });
    </script>

@endsection
