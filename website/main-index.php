<?php if (!defined('FLUX_ROOT')) exit; ?>

<div class="ro-home">
  <section class="ro-hero">
    <div class="ro-kicker">Your adventure begins here</div>
    <h1>Forge your legend in Rune Midgard.</h1>
    <p>Meet new friends, explore unforgettable places, challenge mighty monsters, and create your own Ragnarok story.</p>
    <div class="ro-actions">
      <a class="ro-button" href="?module=account&amp;action=create">Create an Account</a>
      <a class="ro-button secondary" href="?module=server&amp;action=info">Explore Server Info</a>
    </div>
  </section>

  <h2 class="ro-section-title">Welcome to <?php echo htmlspecialchars(Flux::config('SiteTitle')) ?></h2>
  <div class="ro-grid">
    <div class="ro-card"><span class="ro-icon" aria-hidden="true">⚔</span><strong>Adventure &amp; Progress</strong><span>Build your character and prepare for the journey ahead.</span></div>
    <div class="ro-card"><span class="ro-icon" aria-hidden="true">🏰</span><strong>Guilds &amp; Community</strong><span>Find your party, make friends, and stand together.</span></div>
    <div class="ro-card"><span class="ro-icon" aria-hidden="true">🏆</span><strong>Rankings &amp; Competition</strong><span>Track the legends of Rune Midgard as game services come online.</span></div>
  </div>

  <div class="ro-note">The control-panel website is online. Game-server connectivity, live status, rankings, and game data will be enabled after the rAthena server is installed and connected.</div>

  <h2 class="ro-section-title">Latest News &amp; Announcements</h2>
  <?php if (Flux::config('CMSNewsOnHomepage')): ?>
    <?php if (isset($newstype) && $newstype == '1' && !empty($news)): ?>
      <?php foreach ($news as $nrow): ?>
        <article class="ro-news">
          <h3><?php echo htmlspecialchars($nrow->title) ?></h3>
          <small>Posted by <?php echo htmlspecialchars($nrow->author) ?> · <?php echo date(Flux::config('DateFormat'), strtotime($nrow->created)) ?></small>
          <div><?php echo $nrow->body ?></div>
          <?php if (!empty($nrow->link)): ?><a href="<?php echo htmlspecialchars($nrow->link) ?>">Read more</a><?php endif; ?>
        </article>
      <?php endforeach; ?>
    <?php elseif (isset($newstype) && $newstype == '2' && isset($xml) && isset($xml->channel)): ?>
      <?php $roNewsCount = 0; ?>
      <?php foreach ($xml->channel->item as $rssItem): ?>
        <?php if (++$roNewsCount > (int)$newslimit) break; ?>
        <article class="ro-news">
          <h3><?php echo htmlspecialchars((string)$rssItem->title) ?></h3>
          <small><?php echo !empty($rssItem->pubDate) ? date(Flux::config('DateFormat'), strtotime((string)$rssItem->pubDate)) : '' ?></small>
          <p><?php echo htmlspecialchars((string)$rssItem->description) ?></p>
          <a href="<?php echo htmlspecialchars((string)$rssItem->link) ?>" target="_blank" rel="noopener noreferrer">Read more</a>
        </article>
      <?php endforeach; ?>
      <?php if ($roNewsCount === 0): ?><p class="ro-note">No announcements have been posted yet. Please check back soon.</p><?php endif; ?>
    <?php else: ?>
      <p class="ro-note">No announcements have been posted yet. Please check back soon.</p>
    <?php endif; ?>
  <?php else: ?>
    <p class="ro-note">Announcements will appear here. Check back for news and updates.</p>
  <?php endif; ?>
</div>
