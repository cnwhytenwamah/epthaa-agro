@extends('admin.layout.app')

@section('content')	
    <!-- Header -->
    <div class="panel-header bg-dark-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Manage Withdrawals</h2>
                    <h5 class="text-white op-7 mb-2">Review and process user withdrawal requests</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Body -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <div class="page-inner mt--5"> 
        <!-- Statistics Cards -->
        <div class="row">
            <div class="col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center bubble-shadow-small">
                                    <i class="fas fa-clock text-pink"></i>
                                </div>
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Pending</p>
                                    <h4 class="card-title">${{ number_format($stats['pending_amount'] ?? 0, 2) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center bubble-shadow-small">
                                    <i class="fas fa-check text-pink"></i>
                                </div>
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Approved</p>
                                    <h4 class="card-title">${{ number_format($stats['approved_amount'] ?? 0, 2) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center bubble-shadow-small">
                                    <i class="fas fa-check-double text-pink"></i>
                                </div>
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Completed</p>
                                    <h4 class="card-title">${{ number_format($stats['completed_amount'] ?? 0, 2) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center bubble-shadow-small">
                                    <i class="fas fa-times text-pink"></i> 
                                </div>
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Rejected</p>
                                    <h4 class="card-title">${{ number_format($stats['rejected_amount'] ?? 0, 2) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Withdrawals Table -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">All Withdrawal Requests</h4>
                            <div class="btn-group">
                                <button class="btn btn-sm btn-pink filter-status" data-status="all">All</button>
                                <button class="btn btn-sm btn-pink filter-status" data-status="pending">Pending</button>
                                <button class="btn btn-sm btn-pink filter-status" data-status="approved">Approved</button>
                                <button class="btn btn-sm btn-pink filter-status" data-status="completed">Completed</button>
                                <button class="btn btn-sm btn-pink filter-status" data-status="rejected">Rejected</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="withdrawalTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Date</th>
                                        <th>Method</th>
                                        <th>Network</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($withdrawals ?? [] as $withdrawal)
                                    <tr data-status="{{ $withdrawal->status }}">
                                        <td>{{ $withdrawal->id }}</td>
                                        <td>
                                            <strong>{{ $withdrawal->user->name ?? 'N/A' }}</strong><br>
                                            <small class="text-muted">{{ $withdrawal->user->email ?? '' }}</small>
                                        </td>
                                        <td>{{ $withdrawal->created_at->format('M d, Y H:i') }}</td>
                                        <td>{{ $withdrawal->method }}</td>
                                        <td><span class="badge badge-secondary">{{ $withdrawal->network }}</span></td>
                                        <td><strong>${{ number_format($withdrawal->amount, 2) }}</strong></td>
                                        <td>
                                            @if($withdrawal->status == 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($withdrawal->status == 'approved')
                                                <span class="badge badge-success">Approved</span>
                                            @elseif($withdrawal->status == 'completed')
                                                <span class="badge badge-primary">Completed</span>
                                            @else
                                                <span class="badge badge-danger">Rejected</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-sm btn-pink view-details" 
                                                        data-id="{{ $withdrawal->id }}"
                                                        data-user="{{ $withdrawal->user->name ?? 'N/A' }}"
                                                        data-email="{{ $withdrawal->user->email ?? '' }}"
                                                        data-method="{{ $withdrawal->method }}"
                                                        data-network="{{ $withdrawal->network }}"
                                                        data-amount="{{ $withdrawal->amount }}"
                                                        data-wallet="{{ $withdrawal->wallet_address }}"
                                                        data-status="{{ $withdrawal->status }}"
                                                        data-date="{{ $withdrawal->created_at->format('M d, Y H:i') }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                
                                                @if($withdrawal->status == 'pending')
                                                    <form action="{{ route('admin.withdrawals.approve', $withdrawal->id) }}" method="POST" style="display:inline;" class="approve-form">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-pink" title="Approve">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                    <button class="btn btn-sm btn-pink reject-btn" 
                                                            data-id="{{ $withdrawal->id }}" 
                                                            title="Reject">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                @endif
                                                
                                                @if($withdrawal->status == 'approved')
                                                    <button class="btn btn-sm btn-pink complete-btn" 
                                                            data-id="{{ $withdrawal->id }}" 
                                                            title="Mark as Completed">
                                                        <i class="fas fa-check-double"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No withdrawal requests found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- View Details Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Withdrawal Details</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Withdrawal ID:</strong> <span id="detail-id"></span></p>
                            <p><strong>User:</strong> <span id="detail-user"></span></p>
                            <p><strong>Email:</strong> <span id="detail-email"></span></p>
                            <p><strong>Date:</strong> <span id="detail-date"></span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Method:</strong> <span id="detail-method"></span></p>
                            <p><strong>Network:</strong> <span id="detail-network"></span></p>
                            <p><strong>Amount:</strong> <span id="detail-amount"></span></p>
                            <p><strong>Status:</strong> <span id="detail-status"></span></p>
                        </div>
                    </div>
                    <hr>
                    <p><strong>Wallet Address / Account Details:</strong></p>
                    <div class="alert alert-secondary">
                        <span id="detail-wallet"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="rejectForm" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Reject Withdrawal</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to reject this withdrawal request?</p>
                        <div class="form-group">
                            <label>Reason for Rejection (Optional)</label>
                            <textarea name="reason" class="form-control" rows="3" placeholder="Enter reason..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Reject Withdrawal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Complete Modal -->
    <div class="modal fade" id="completeModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="completeForm" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Complete Withdrawal</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Mark this withdrawal as completed?</p>
                        <div class="form-group">
                            <label>Transaction Hash (Optional)</label>
                            <input type="text" name="transaction_hash" class="form-control" placeholder="Enter transaction hash...">
                            <small class="form-text text-muted">For crypto withdrawals, enter the blockchain transaction hash</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Mark as Completed</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // View details
        document.querySelectorAll(".view-details").forEach(button => {
            button.addEventListener("click", function() {
                document.getElementById("detail-id").textContent = this.dataset.id;
                document.getElementById("detail-user").textContent = this.dataset.user;
                document.getElementById("detail-email").textContent = this.dataset.email;
                document.getElementById("detail-method").textContent = this.dataset.method;
                document.getElementById("detail-network").textContent = this.dataset.network;
                document.getElementById("detail-amount").textContent = "$" + parseFloat(this.dataset.amount).toFixed(2);
                document.getElementById("detail-wallet").textContent = this.dataset.wallet;
                document.getElementById("detail-status").textContent = this.dataset.status.toUpperCase();
                document.getElementById("detail-date").textContent = this.dataset.date;
                
                $("#detailsModal").modal("show");
            });
        });

        // Reject withdrawal
        document.querySelectorAll(".reject-btn").forEach(button => {
            button.addEventListener("click", function() {
                const id = this.dataset.id;
                document.getElementById("rejectForm").action = `/admin/withdrawals/${id}/reject`;
                $("#rejectModal").modal("show");
            });
        });

        // Complete withdrawal
        document.querySelectorAll(".complete-btn").forEach(button => {
            button.addEventListener("click", function() {
                const id = this.dataset.id;
                document.getElementById("completeForm").action = `/admin/withdrawals/${id}/complete`;
                $("#completeModal").modal("show");
            });
        });

        // Confirm approve
        document.querySelectorAll(".approve-form").forEach(form => {
            form.addEventListener("submit", function(e) {
                if (!confirm("Are you sure you want to approve this withdrawal?")) {
                    e.preventDefault();
                }
            });
        });

        // Filter by status
        document.querySelectorAll(".filter-status").forEach(button => {
            button.addEventListener("click", function() {
                const status = this.dataset.status;
                const rows = document.querySelectorAll("#withdrawalTable tbody tr[data-status]");
                
                document.querySelectorAll(".filter-status").forEach(btn => {
                    btn.classList.remove("active");
                });
                this.classList.add("active");
                
                rows.forEach(row => {
                    if (status === "all" || row.dataset.status === status) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            });
        });
    });
    </script>
@endsection