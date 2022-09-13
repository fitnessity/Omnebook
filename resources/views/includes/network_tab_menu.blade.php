  <?php
    $currentPath = explode("/", Request::path());
  ?>
	<div class="business-title">
      <h1>WELCOME TO FITNESSITY</h1>
      <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 

        Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.</p>
    </div>

    <div class="business-menu">
        <ul>
          <li><a href="/network/mynetwork" class="@if($currentPath[1] == 'mynetwork') active-tab @endif">My Network</a></li>
          <li>
            <a href="/network/pendingNetworkInvitation" class="@if($currentPath[1] == 'pendingNetworkInvitation') active-tab @endif">
              Pending Invitations
            </a>
          </li>
          <li><a href="/network/getcontacts" class="@if($currentPath[1] == 'getcontacts') active-tab @endif">Invite Friends</a></li>
        </ul>
    </div>