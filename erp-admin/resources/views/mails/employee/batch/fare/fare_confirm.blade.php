----------------------------------------------------------------<br>
対象月：{{ $month }}<br>
<br>
対象件数：{{ $countAll }}件<br>
<br>
成功：{{ $successCount }}件<br>
@foreach($successProfiles as $successProfile)
  {{ $successProfile->erp_id }}：{{ $successProfile->name }}<br>
@endforeach
<br>
失敗：{{ $failCount }}件<br>
@foreach($failFares as $failFare)
  {{ $failFare->erp_id }}：{{ \App\Models\Fare::CONFIRM_STATUS_LIST[$failFare->confirm_status] }}<br>
@endforeach
<br>
----------------------------------------------------------------<br>