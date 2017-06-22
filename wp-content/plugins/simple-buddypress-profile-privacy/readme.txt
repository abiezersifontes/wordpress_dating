=== Simple Buddypress Profile Privacy ===
Contributors: fencer04
Tags: buddypress, privacy, profile privacy
Requires at least: 4.0
Tested up to: Wordpress 4.7 alpha-38807 / Buddypress 2.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Stable tag: trunk

Allow your members to select additional privacy settings for who can view their profile and it's visibility on the directory page.

== Description ==

Allow your members to select additional privacy settings for who can view their profile and it's visibility on the directory page.

1. Allow users to hide their profile from the directory page. There is an admin setting to allow or deny this setting site wide.
2. Allow each Buddypress member to decide which members can see any of their profile tabs.

The options for profile viewing privacy are:

1. "Only logged in users": any visitor that isn't logged in will be redirected to the registration page.
2. "Only friends": a visitor who is not a friend views a profile they will see a new tab named private giving them an opporunity to become friends with the member.
3. "Everyone": Buddypress functions as if the plugin is not installed.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/buddy-press-profile-privacy` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress

== Frequently Asked Questions ==

= Are the profiles hidden from site administrators? =

No site administrators or super admins can view all profiles regardless of their settings.

= Does this plugin affect hidden profile fields? =

No, any profile fields that are hidden will be hidden no matter what the settings are. This plugin is for overall profile privacy.

== Screenshots ==


== Changelog ==

= 0.7.2 =
1. Resolve bug where user couldn't save admin setting that allows users to hide their profiles from directory. Props to chanew!

= 0.7.1 =
1. Add admin notification for new hide from directory admin option.

= 0.7 =
1. Added setting for members to hide their profile from directory.
2. Added admin setting to disable the new setting for members to hide from directory.

= 0.6 =
1. Only offer friends only option if Friends Component is active.
2. Fix issues related to Friends Component being made inactive after member selects Friend's only option.

= 0.5 =
1. This is the initial version that was uploaded.