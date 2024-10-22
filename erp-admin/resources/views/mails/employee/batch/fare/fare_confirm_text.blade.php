----------------------------------------------------------------
対象月：{{ $month }}

対象件数：{{ $countAll }}件

成功：{{ $successCount }}件
@foreach($successProfiles as $successProfile)
　{{ $successProfile->erp_id }}：{{ $successProfile->name }}
@endforeach

失敗：{{ $failCount }}件
@foreach($failFares as $failFare)
　{{ $failFare->erp_id }}：{{ \App\Models\Fare::CONFIRM_STATUS_LIST[$failFare->confirm_status] }}
@endforeach

----------------------------------------------------------------