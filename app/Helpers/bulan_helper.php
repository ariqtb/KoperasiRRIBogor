<?php

function bulanan($bulan)
     {
         if ($bulan === '1' || $bulan === '01') {
             $nama_bulan = 'Januari';
         } elseif ($bulan === '2' || $bulan === '02') {
             $nama_bulan = 'Februari';
         } elseif ($bulan === '3' || $bulan === '03') {
             $nama_bulan = 'Maret';
         } elseif ($bulan === '4' || $bulan === '04') {
             $nama_bulan = 'April';
         } elseif ($bulan === '5' || $bulan === '05') {
             $nama_bulan = 'Mei';
         } elseif ($bulan === '6' || $bulan === '06') {
             $nama_bulan = 'Juni';
         } elseif ($bulan === '7' || $bulan === '07') {
             $nama_bulan = 'Juli';
         } elseif ($bulan === '8' || $bulan === '08') {
             $nama_bulan = 'Agustus';
         } elseif ($bulan === '9' || $bulan === '09') {
             $nama_bulan = 'September';
         } elseif ($bulan === '10') {
             $nama_bulan = 'Oktober';
         } elseif ($bulan === '11') {
             $nama_bulan = 'November';
         } elseif ($bulan === '12') {
             $nama_bulan = 'Desember';
         } else {
             $nama_bulan = date("Y");
         }

         return $nama_bulan;
     }