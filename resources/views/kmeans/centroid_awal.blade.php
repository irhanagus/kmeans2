<div class="card card-info card-outline">
    <h4 class="m-0"><center>Centroid Awal</center></h4>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th><center>NIS</center></th>
                <th><center>Centroid</center></th>
                <th><center>% Kehadiran<br>Pengajian</center></th>
                <th><center>% Kehadiran<br>Piket</center></th>
                <th><center>Poin<br>Pelanggaran</center></th>
                <th><center>Tingkat<br>Bacaan</center></th>
                <th><center>Tingkat<br>Makna</center></th>
                <th><center>Ket.</center></th>
            </tr>
            @if($aktivsantriterbesar)
                <tr>
                    <td><center>{{ $aktivsantriterbesar->nis }}</center></td>
                    {{-- <td><center>{{ $aktivsantriterbesar->nama }}</center></td> --}}
                    <td><center>1</center></td>
                    <td><center>{{ $aktivsantriterbesar->hasil_ngaji }}</center></td>
                    <td><center>{{ $aktivsantriterbesar->hasil_piket }}</center></td>
                    <td><center>{{ $aktivsantriterbesar->hasil_pelanggaran }}</center></td>
                    <td><center>{{ $aktivsantriterbesar->hasil_bacaan }}</center></td>
                    <td><center>{{ $aktivsantriterbesar->hasil_makna }}</center></td>
                    {{-- <td><center>{{ $aktivsantriterbesar->rata }}</center></td> --}}
                    <td><center>Cluster 1</center></td>
                </tr>
            @else
                <tr>
                    <td colspan="8"><center>Tidak ada data dengan rata terbesar.</center></td>
                </tr>
            @endif

            @if($aktivsantritengah)
                <tr>
                    <td><center>{{ $aktivsantritengah->nis }}</center></td>
                    {{-- <td><center>{{ $aktivsantritengah->nama }}</center></td> --}}
                    <td><center>2</center></td>
                    <td><center>{{ $aktivsantritengah->hasil_ngaji }}</center></td>
                    <td><center>{{ $aktivsantritengah->hasil_piket }}</center></td>
                    <td><center>{{ $aktivsantritengah->hasil_pelanggaran }}</center></td>
                    <td><center>{{ $aktivsantritengah->hasil_bacaan }}</center></td>
                    <td><center>{{ $aktivsantritengah->hasil_makna }}</center></td>
                    {{-- <td><center>{{ $aktivsantritengah->rata }}</center></td> --}}
                    <td><center>Cluster 2</center></td>
                </tr>
            @else
                <tr>
                    <td colspan="8"><center>Tidak ada data dengan rata tidak besar dan tidak kecil.</center></td>
                </tr>
            @endif

            @if($aktivsantriterkecil)
                <tr>
                    <td><center>{{ $aktivsantriterkecil->nis }}</center></td>
                    {{-- <td><center>{{ $aktivsantriterkecil->nama }}</center></td> --}}
                    <td><center>3</center></td>
                    <td><center>{{ $aktivsantriterkecil->hasil_ngaji }}</center></td>
                    <td><center>{{ $aktivsantriterkecil->hasil_piket }}</center></td>
                    <td><center>{{ $aktivsantriterkecil->hasil_pelanggaran }}</center></td>
                    <td><center>{{ $aktivsantriterkecil->hasil_bacaan }}</center></td>
                    <td><center>{{ $aktivsantriterkecil->hasil_makna }}</center></td>
                    {{-- <td><center>{{ $aktivsantriterkecil->rata }}</center></td> --}}
                    <td><center>Cluster 3</center></td>
                </tr>
            @else
                <tr>
                    <td colspan="8"><center>Tidak ada data dengan rata terkecil.</center></td>
                </tr>
            @endif
        </table>
    </div>
</div>
