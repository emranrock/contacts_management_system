<?php $session = session(); ?>
 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar control-sidebar ">
   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">
     <div class="user-panel">
       <div class="pull-left image">
         <img src="<?php echo base_url('assets/admin/dist/img/user2-160x160.jpg'); ?>" class="img-circle" alt="User Image">
       </div>
       <div class="pull-right info">
         <p><?= $session->get('userId') ? $session->get('roleText') : 'Guest' ?></p>
         <a href="#">
           <div id="status"><i class="fa fa-circle text-success"></i><?php echo 'online'; ?> </div>
         </a>

       </div>
     </div>
    
     <!-- sidebar menu: : style can be found in sidebar.less -->
     <ul class="sidebar-menu">
       <!-- <select name="store" class="form-control select2">
         <option value="">Select Store</option>
       </select> -->
       <li class="header">MAIN NAVIGATION</li>
       <li class="treeview">
         <a href="<?php echo base_url('admin'); ?>">
           <i class="fa fa-dashboard"></i><span> <?php echo 'Dashboard'; ?></span>
         </a>
       </li>
       <li class="treeview">
         <a href="<?php echo base_url('admin/analytics'); ?>">
           <i class="fa fa-pie-chart"></i><span> <?php echo 'Analytics'; ?></span>

         </a>
       </li>
       <li class="treeview">
         <a href="#">
           <i class="fa fa-gear"></i><span><?php echo 'Settings'; ?>
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li><a href="<?php echo base_url('admin/settings'); ?>">
               <i class="fa fa-circle-o"></i>Stores</a>
           </li>
           <li><a href="<?php echo base_url('admin/couriers/manage'); ?>">
               <i class="fa fa-circle-o"></i>Couriers</a>
           </li>
           <li><a href="<?php echo base_url('admin/settings/general_setting'); ?>">
               <i class="fa fa-circle-o"></i>General Setting</a>
           </li>
           <li><a href="<?php echo base_url('admin/settings/pre_booking_items'); ?>">
               <i class="fa fa-circle-o"></i>Pre Booking Items</a>
           </li>
           <li><a href="<?php echo base_url('admin/settings/racks'); ?>">
               <i class="fa fa-circle-o"></i>Racks Settings</a>
           </li>
           <li><a href="<?php echo base_url('admin/settings/bulk'); ?>">
               <i class="fa fa-circle-o"></i>Bulk Upload</a>
           </li>
           <li><a href="<?php echo base_url('admin/settings/add_barcode'); ?>">
               <i class="fa fa-circle-o"></i>Add Barcodes to Racks</a>
           </li>
           <li><a href="<?php echo base_url('admin/settings/add_tags'); ?>">
               <i class="fa fa-circle-o"></i>Add Tags</a>
           </li>
           <li><a href="<?php echo base_url('admin/options/manage'); ?>">
               <i class="fa fa-circle-o"></i>Manage Options</a>
           </li>
           <li><a href="<?php echo base_url('admin/settings/add_payment_methods'); ?>"><i class="fa fa-circle-o"></i>Add Payment Methods</a></li>
           <li><a href="<?php echo base_url('admin/settings/roles'); ?>"> <i class="fa fa-circle-o"></i>Manage Roles</a></li>

         </ul>
       </li>
       <li class="treeview">
         <a href="<?php echo base_url('admin/employees/manage'); ?>">
           <i class="fa fa-child"></i>
           <span><?php echo 'Employees'; ?></span>
         </a>
       </li>
       <li class="treeview">
         <a href="<?php echo base_url('admin/working'); ?>">
           <i class="fa fa-clock-o"></i>
           <span><?php echo 'Working Time'; ?></span>
         </a>
       </li>
       <li class="treeview">
         <a href="<?php echo base_url('admin/user_credits'); ?>">
           <i class="fa fa-money"></i>
           <span><?php echo 'Credits'; ?></span>
         </a>
       </li>
       <li class="treeview">
         <a href="#">
           <i class="fa fa-check-square"></i>
           <span><?php echo 'Forward Management'; ?></span>
           <i class="fa fa-angle-left pull-right"></i>

         </a>
         <ul class="treeview-menu">
           <li><a href="<?php echo base_url('admin/forward'); ?>">
               <i class="fa fa-circle-o"></i>Add Orders</a>
           </li>
           <!-- <li><a href="<?php echo base_url('admin/forward/pending'); ?>">
               <i class="fa fa-circle-o"></i>Pending Orders</a>
           </li> -->
           <li><a href="<?php echo base_url('admin/forward/un_assign'); ?>">
               <i class="fa fa-circle-o"></i>un-Assign</a>
           </li>
           <li><a href="<?php echo base_url('admin/forward/manage'); ?>">
               <i class="fa fa-circle-o"></i>Assigned</a>
           </li>
           <li><a href="<?php echo base_url('admin/forward/delivered'); ?>">
               <i class="fa fa-circle-o"></i>Delivered</a>
           </li>
          
           <li>
              <a href="#">
              <i class="fa fa-barcode"></i> <span>Barcode</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
             <ul class="treeview-menu">
               <li><a href="<?php echo base_url('admin/forward/scan'); ?>">
                   <i class="fa fa-circle-o"></i>
                   <span>Scan</span>
                 </a>
               </li>
               <li><a href="<?php echo base_url('admin/forward/scan_log'); ?>">
                   <i class="fa fa-circle-o"></i>
                   <span>Logs</span>
                 </a>
               </li>
             </ul>
           </li>
           <li><a href="<?php echo base_url('admin/forward/canceled_orders'); ?>">
               <i class="fa fa-circle-o"></i>Cancels</a>
           </li>
         </ul>
       </li>

       <li class="treeview">
         <a href="#">
           <i class="fa fa-check-square-o"></i><span><?php echo 'Return Management'; ?></span>
           <i class="fa fa-angle-left pull-right"></i>

         </a>
         <ul class="treeview-menu">
           <li><a href="<?php echo base_url('admin/returns'); ?>">
               <i class="fa fa-circle-o"></i>Add</a>
           </li>
           <li><a href="<?php echo base_url('admin/returns/manage'); ?>">
               <i class="fa fa-circle-o"></i>Assign</a>
           </li>
           <li><a href="<?php echo base_url('admin/returns/received'); ?>">
               <i class="fa fa-circle-o"></i>Received</a>
           </li>
           <li><a href="<?php echo base_url('admin/returns/restock'); ?>">
               <i class="fa fa-circle-o"></i>Restock</a>
           </li>
         </ul>
       </li>
       <li class="treeview">
         <a href="#">
           <i class="fa fa-arrow-circle-left"></i><span><?php echo 'Non-Delivery Report'; ?></span>
           <i class="fa fa-angle-left pull-right"></i>

         </a>
         <ul class="treeview-menu">
           <li><a href="<?php echo base_url('admin/ndr/forwards'); ?>">
               <i class="fa fa-circle-o"></i>Forwards</a>
           </li>
           <li><a href="<?php echo base_url('admin/ndr/returns'); ?>">
               <i class="fa fa-circle-o"></i>Returns</a>
           </li>
         </ul>
       </li>
       <li class="treeview">
         <a href="#">
           <i class="fa fa-arrow-left"></i><span><?php echo 'Return To Origen'; ?></span>
           <i class="fa fa-angle-left pull-right"></i>
         </a>
         <ul class="treeview-menu">
           <li><a href="<?php echo base_url('admin/rto/forwards'); ?>">
               <i class="fa fa-circle-o"></i>Forwards</a>
           </li>
           <!-- <li><a href="<?php echo base_url('admin/rto/returns'); ?>">
               <i class="fa fa-circle-o"></i>Returns</a>
           </li> -->
         </ul>
       </li>
       <li class="treeview">
         <a href="#">
           <i class="fa fa-arrow-circle-left"></i><span><?php echo 'Shipment Management'; ?></span>
           <i class="fa fa-angle-left pull-right"></i>

         </a>
         <ul class="treeview-menu">
           <li><a href="<?php echo base_url('admin/shipment'); ?>">
               <i class="fa fa-circle-o"></i>Add</a>
           </li>
           <li><a href="<?php echo base_url('admin/shipment/manage'); ?>">
               <i class="fa fa-circle-o"></i>Manage</a>
           </li>
           <li>
             <a href="<?php echo base_url('admin/shipment/scan'); ?>">
               <i class="fa fa-barcode"></i>
               <span>Scan Barcode</span>
             </a>
           </li>
         </ul>
       </li>
       <li class="treeview">
         <a href="#">
           <i class="fa fa-calculator"></i><span><?php echo 'Reconcile'; ?></span>
           <i class="fa fa-angle-left pull-right"></i>
         </a>
         <ul class="treeview-menu">
           <li><a href="<?php echo base_url('admin/reconcile/shiprocket'); ?>">
               <i class="fa fa-circle-o"></i>Shiprocket</a>
           </li>
           <li><a href="<?php echo base_url('admin/reconcile/shyft_go'); ?>">
               <i class="fa fa-circle-o"></i>ShyftGo</a>
           </li>
         </ul>
       </li>
       <li class="treeview">
         <a href="#">
           <i class="fa fa-tags"></i><span><?php echo 'Tag Updates'; ?></span>
           <i class="fa fa-angle-left pull-right"></i>

         </a>
         <ul class="treeview-menu">
           <li><a href="<?php echo base_url('admin/tag_updates/manage'); ?>">
               <i class="fa fa-circle-o"></i>Updates</a>
           </li>
         </ul>
       </li>
       <li class="treeview">
         <a href="<?php echo base_url('admin/cron_job/view'); ?>">
           <i class="fa fa-eye"></i>
           <span><?php echo 'Cron Job Status'; ?></span>
         </a>
       </li>
       <li class="treeview">
         <a href="<?php echo base_url('admin/logs'); ?>">
           <i class="fa fa-camera"></i>
           <span><?php echo 'Logs'; ?></span>
         </a>
       </li>
       <li class="treeview">
         <a href="#">
           <i class="fa fa-share"></i> <span>Multilevel</span>
           <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
           </span>
         </a>
         <ul class="treeview-menu">
           <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
           <li class="treeview">
             <a href="#"><i class="fa fa-circle-o"></i> Level One
               <span class="pull-right-container">
                 <i class="fa fa-angle-left pull-right"></i>
               </span>
             </a>
             <ul class="treeview-menu">
               <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
               <li class="treeview">
                 <a href="#"><i class="fa fa-circle-o"></i> Level Two
                   <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                   </span>
                 </a>
                 <ul class="treeview-menu">
                   <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                   <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                 </ul>
               </li>
             </ul>
           </li>
           <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
         </ul>
       </li>
   </section>
   <!-- /.sidebar -->
 </aside>